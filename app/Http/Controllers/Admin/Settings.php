<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

class Settings extends Controller
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
            'nav_name' => 'setting',
        ];

        return view('admin.index-setting', $manifest);
    }

    public function app()
    {
        Auth::user();
        $identity = $this->identity();
        $cache = Cache::get('settings');

        if (!empty($cache)) {

            foreach ($cache as $value) {

                $site_name = $value->site_name;
                $registration = $value->registration;
            }
        } else {

            $cache = Cache::rememberForever('settings', function () {
                return DB::table('settings')->get();
            });

            foreach ($cache as $value) {

                $site_name = $value->site_name;
                $registration = $value->registration;
            }
        }

        $manifest = [
            'site_name' => $identity['site_name'],
            'nav_role' => 'admin',
            'nav_name' => 'setting',
            'site_name' => $site_name,
            'registration' => $registration,
        ];

        return view('admin.setting-app', $manifest);
    }

    public function update_app(Request $request)
    {
        Auth::user();

        if ($request->ajax()) {

            $params = [
                'site_name' => 'required|min:3|regex:/^[a-zA-Z0-9\s]+$/',
                'registration' => 'required',
            ];

            $attributes = [
                'site_name' => 'nama aplikasi',
                'registration' => 'pendaftaran akun',
            ];

            $validator = Validator::make($request->all(), $params);
            $validator->setAttributeNames($attributes);

            if ($validator->passes()) {

                $registration = $request->registration == 1 ? 1 : 0;

                DB::table('settings')->update([
                    'site_name' => $request->site_name,
                    'registration' => $registration,
                ]);
                
                Cache::flush();

                return response()->json([
                    'code' => 201,
                    'success' => true,
                    'message' => "Pengaturan aplikasi berhasil diperbarui",
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
                'message' => "Pengaturan aplikasi gagal diperbarui",
            ]);
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
