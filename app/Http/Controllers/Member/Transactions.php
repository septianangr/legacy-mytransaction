<?php

namespace App\Http\Controllers\Member;

use Auth;
use Validator;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

class Transactions extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'member']);
    }

    public function index()
    {
        Auth::user();

        $identity = $this->identity();

        $manifest = [
            'site_name' => $identity['site_name'],
            'nav_role' => 'member',
            'nav_name' => 'transaction',
        ];

        return view('member.index-transaction', $manifest);
    }

    public function get(Request $request)
    {
        $user = Auth::user();
        $userID = $user->id;

        if ($request->ajax()) {

            $number = 1;
            $option = $request->period;
            $keyword = $request->keyword;
            $transactions = new Transaction;

            switch ($option) {

                case "yesterday":

                    $date = date('Y-m-d', strtotime('-1 days'));

                    $data = $transactions->FindData($userID, $date, NULL, $keyword);

                    break;

                case "today":

                    $date = date('Y-m-d');

                    $data = $transactions->FindData($userID, $date, NULL, $keyword);

                    break;

                case "last7":

                    $period = [
                        date('Y-m-d', strtotime('-6 days')),
                        date('Y-m-d'),
                    ];

                    $data = $transactions->FindData($userID, NULL, $period, $keyword);

                    break;

                case "last30":

                    $period = [
                        date('Y-m-d', strtotime('-29 days')),
                        date('Y-m-d'),
                    ];

                    $data = $transactions->FindData($userID, NULL, $period, $keyword);

                    break;

                case "all":

                    $data = $transactions->FindData($userID, NULL, NULL, $keyword);

                    break;

                default:

                    $data = $transactions->FindData($userID, NULL, NULL, $keyword);
            }

            $row_total = count($data);

            if ($row_total >= 1) {

                foreach ($data as $value) {

                    $amounts[] = $value->amount;

                    $result[] = [
                        'number' => $number++,
                        'date' => date('d M Y', strtotime($value->date)),
                        'time' => $value->time,
                        'amount' => 'Rp. ' . number_format($value->amount),
                        'info' => $value->info,
                        'delete' => '<button class="btn btn-sm btn-danger" id="btn-delete" data-id="' . $value->id . '"><i class="fal fa-trash-alt"></i></button>',
                    ];
                }

                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'row' => $result,
                    'count' => $row_total,
                    'sum' => number_format(array_sum($amounts)),
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
            'nav_role' => 'member',
            'nav_name' => 'add-transaction',
        ];

        return view('member.add-transaction', $manifest);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($request->ajax()) {

            $params = [
                'amount' => 'required|numeric|min:100|not_in:0',
                'info' => 'required|max:64',
                'date' => 'required|date',
                'time' => 'required',
            ];

            $attributes = [
                'amount' => 'biaya transaksi',
                'info' => 'keterangan transaksi',
                'date' => 'tanggal transaksi',
                'time' => 'waktu transaksi',
            ];

            $validator = Validator::make($request->all(), $params);
            $validator->setAttributeNames($attributes);

            if ($validator->passes()) {

                Transaction::create([
                    'user_id' => $user->id,
                    'amount' => $request->amount,
                    'info' => $request->info,
                    'date' => $request->date,
                    'time' => $request->time,
                ]);

                return response()->json([
                    'code' => 201,
                    'success' => true,
                    'message' => "Data transaksi Kamu berhasil disimpan",
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
                'message' => "Data transaksi gagal disimpan",
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        if ($request->ajax()) {

            $affected_row = Transaction::where('id', $request->id)
                ->where('user_id', $user->id)
                ->delete();

            if ($affected_row == 1) {

                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => "Data transaksi kamu berhasil dihapus",
                ]);
            } else {

                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => "Gagal menghapus data transaksi yang dipilih",
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
