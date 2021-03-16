<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {

            if ($user->role == 1) {

                return redirect()->route('admin.home');
            } elseif ($user->role == 2) {

                return redirect()->route('member.home');
            } else {

                return redirect()->route('auth.logout');
            }
        } else {

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
                'site_name' => $site_name,
                'registration' => $registration,
            ];

            return view('auth.login', $manifest);
        }
    }

    public function login(Request $request)
    {
        if ($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $validator->setAttributeNames([
                'email' => 'Alamat email',
                'password' => 'Password',
            ]);

            if ($validator->passes()) {

                $params  = [
                    'email' => $request->email,
                    'password' => $request->password,
                ];

                $remember = $request->remember == 1 ? TRUE : FALSE;

                if (Auth::attempt($params, $remember)) {

                    $user = Auth::user();

                    if ($user->role == 1) {

                        $redirect = route('admin.home');
                    } elseif ($user->role == 2) {

                        $redirect = route('member.home');
                    } else {

                        $redirect = route('auth.logout');
                    }

                    return response()->json([
                        'success' => true,
                        'message' => "Proses login akun berhasil",
                        'redirect' => $redirect,
                    ]);
                }

                return response()->json([
                    'success' => false,
                    'message' => "Alamat email atau password login tidak sesuai",
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect()->route('auth.login');
    }
}
