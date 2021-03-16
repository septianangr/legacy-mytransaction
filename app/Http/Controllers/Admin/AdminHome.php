<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

class AdminHome extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $user = Auth::user();
        $identity = $this->identity();

        $admins = DB::table('users')->where('role', 1)->get()->count();
        $users = DB::table('users')->where('role', 2)->get()->count();
        $transactions = DB::table('transactions')->sum('amount');

        $manifest = [
            'site_name' => $identity['site_name'],
            'nav_role' => 'admin',
            'nav_name' => 'home',
            'full_name' => $user->name,
            'admins' => $admins,
            'users' => $users,
            'transactions' => $transactions,
        ];

        return view('admin.index-home', $manifest);
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
