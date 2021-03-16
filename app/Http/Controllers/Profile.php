<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Profile extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($request->ajax()) {
        
            if ($request->email != $user->email) {
    
                if (! empty($request->password)) {
    
                    $validator = Validator::make($request->all(), [
                        'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                        'email' => 'required|email|unique:users',
                        'password' => 'min:8|confirmed',
                        'password_confirmation' => 'min:8',
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
                        'password' => 'min:8|confirmed',
                        'password_confirmation' => 'min:8',
                    ]);
        
                } else {
        
                    $validator = Validator::make($request->all(), [
                        'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                        'email' => 'required|email',
                    ]);
                }
            }
    
            if ($validator->passes()) {
    
                if (! empty($request->password)) {
    
                    User::where('id', $user->id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);
    
                } else {
    
                    User::where('id', $user->id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                    ]);
                }
    
                return response()->json([
                    'code' => 201,
                    'success' => true,
                    'message' => "Data profil Kamu berhasil diperbarui",
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
                'message' => "Data profil gagal diperbarui",
            ]);
        }
    }
}