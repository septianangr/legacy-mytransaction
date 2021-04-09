<?php

namespace App\Http\Controllers\Member;

use Auth;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

class MemberHome extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'member']);
    }

    public function index()
    {
        $user = Auth::user();
        $userID = $user->id;
        $identity = $this->identity();
        $transactions = new Transaction;

        $epThisMonth = $transactions->GetSUM($userID, date('Y-m'), NULL);
        $epLastMonth = $transactions->GetSUM($userID, date('Y-m', strtotime('-1 month')), NULL);
        $epTotal = $transactions->GetSUM($userID, NULL, NULL);
    
        if ($epTotal != 0) {

            $presentase = ($epThisMonth - $epLastMonth) / $epLastMonth * 100;

            if ($presentase >= 100) {

                $presentase = substr($presentase, 0, 3);
            } else {

                $presentase = substr($presentase, 0, 4);
            } 
        } else {
            $presentase = 0;
        }
        

        $manifest = [
            'site_name' => $identity['site_name'],
            'nav_role' => 'member',
            'nav_name' => 'home',
            'full_name' => $user->name,
            'epThisMonth' => $epThisMonth,
            'epLastMonth' => $epLastMonth,
            'presentase' => abs($presentase),
            'epTotal' => $epTotal,
        ];

        return view('member.index-home', $manifest);
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