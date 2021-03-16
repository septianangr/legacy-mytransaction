<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Validator;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {

            if ($user->role == 2) {

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
            
            if ($registration == 1) {
                
                $manifest = [
                    'site_name' => $site_name,
                    'registration' => $registration,
                ];
                
                return view('auth.register', $manifest);
            }
            
            return redirect()->route('login.index');
        }
    }

    public function register(Request $request)
    {
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
                    'success' => true,
                    'message' => "Proses pendaftaran akun Kamu berhasil",
                    'redirect' => route('login.index'),
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ]);
        }
    }
}