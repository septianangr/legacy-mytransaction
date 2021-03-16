<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

class Users extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        Auth::user();

        $identity = $this->identity();

        $manifest = [
            'site_name' => $identity['site_name'],
            'nav_role' => 'admin',
            'nav_name' => 'users',
        ];

        return view('admin.index-user', $manifest);
    }

    public function get(Request $request)
    {
        Auth::user();

        if ($request->ajax()) {

            $number = 1;
            $length = $request->length;
            $keyword = $request->keyword;
            $users = new User;

            $data = $users->FindData($length, $keyword);

            $row_total = count($data);

            if ($row_total >= 1) {

                foreach ($data as $value) {

                    $result[] = [
                        'number' => $number++,
                        'name' => $value->name,
                        'email' => $value->email,
                        'created_at' => date('Y-m-d H:i:s', strtotime($value->created_at)),
                        'edit' => '<button class="btn btn-sm btn-primary mr-1" id="btn-edit" data-id="' . $value->id . '" data-name="' . $value->name . '" data-email="' . $value->email . '"><i class="fal fa-edit"></i></button>',
                        'delete' => '<button class="btn btn-sm btn-danger" id="btn-delete" data-id="' . $value->id . '"><i class="fal fa-trash-alt"></i></button>',
                    ];
                }

                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'row' => $result,
                    'count' => $row_total,
                ]);
            } else {

                return response()->json([
                    'code' => 400,
                    'success' => false,
                ]);
            }
        }
    }

    public function create()
    {
        Auth::user();

        $identity = $this->identity();

        $manifest = [
            'site_name' => $identity['site_name'],
            'nav_role' => 'admin',
            'nav_name' => 'add-user',
        ];

        return view('admin.add-user', $manifest);
    }

    public function store(Request $request)
    {
        Auth::user();

        if ($request->ajax()) {

            $params = [
                'name' => 'required|min:3|regex:/^[a-zA-Z0-9\s]+$/',
                'email' => 'required|email|unique:users',
                'password' => 'min:8|confirmed',
            ];

            $attributes = [
                'name' => 'nama lengkap',
                'email' => 'alamat email',
                'password' => 'password login',
                'password_confirmation' => 'konfirmasi password',
            ];

            $validator = Validator::make($request->all(), $params);
            $validator->setAttributeNames($attributes);

            if ($validator->passes()) {

                User::create([
                    'role' => 2,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                return response()->json([
                    'code' => 201,
                    'success' => true,
                    'message' => "Data pengguna berhasil disimpan",
                ]);
            } else {

                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => $validator->errors()->all(),
                ]);
            }

            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => "Data pengguna gagal disimpan",
            ]);
        }
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {

            if ($request->email != $request->old_email) {

                if (!empty($request->password)) {

                    $validator = Validator::make($request->all(), [
                        'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                        'email' => 'required|email|unique:users',
                        'password' => 'min:8',
                    ]);
                } else {

                    $validator = Validator::make($request->all(), [
                        'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                        'email' => 'required|email|unique:users',
                    ]);
                }
            } else {

                if (!empty($request->password)) {

                    $validator = Validator::make($request->all(), [
                        'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                        'email' => 'required|email',
                        'password' => 'min:8',
                    ]);
                } else {

                    $validator = Validator::make($request->all(), [
                        'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                        'email' => 'required|email',
                    ]);
                }
            }

            if ($validator->passes()) {

                if (!empty($request->password)) {

                    User::where('id', $request->id)
                        ->where('role', 2)
                        ->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                        ]);
                } else {

                    User::where('id', $request->id)
                        ->where('role', 2)
                        ->update([
                            'name' => $request->name,
                            'email' => $request->email,
                        ]);
                }

                return response()->json([
                    'code' => 201,
                    'success' => true,
                    'message' => "Data pengguna berhasil diperbarui",
                ]);
            } else {

                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => $validator->errors()->all(),
                ]);
            }

            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => "Data pengguna gagal diperbarui",
            ]);
        }
    }

    public function destroy(Request $request)
    {
        Auth::user();

        if ($request->ajax()) {

            Transaction::where('user_id', $request->id)
                ->delete();

            $affected_row = User::where('id', $request->id)
                ->where('role', 2)
                ->delete();

            if ($affected_row == 1) {

                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => "Data pengguna yang dipilih berhasil dihapus",
                ]);
            } else {

                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => "Gagal menghapus data pengguna yang dipilih"
                ]);
            }
        }
    }

    private function identity()
    {
        $cache = Cache::get('settings');

        if (!empty($cache)) {

            foreach ($cache as $value) {

                $identity = [
                    'site_name' => $value->site_name,
                ];
            }
        } else {

            $cache = Cache::rememberForever('settings', function () {
                return DB::table('settings')->get();
            });

            foreach ($cache as $value) {

                $identity = [
                    'site_name' => $value->site_name,
                ];
            }
        }

        return $identity;
    }
}
