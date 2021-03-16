<?php

namespace App\Http\Controllers\Member;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

class MemberProfile extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'member']);
    }

    public function index()
    {
        $user = Auth::user();
        $identity = $this->identity();

        $manifest = [
            'site_name' => $identity['site_name'],
            'nav_role' => 'member',
            'nav_name' => 'setting',
            'name' => $user->name,
            'email' => $user->email,
        ];

        return view('member.setting-profile', $manifest);
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
