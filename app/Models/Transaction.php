<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'id',
        'user_id',
        'amount',
        'info',
        'date',
        'time',
    ];

    public $timestamps = false;

    public function FindData($id, $date, $period, $keyword)
    {
        $query = static::where('user_id', $id)
            ->orderBy('date', 'DESC')
            ->orderBy('time', 'DESC');

        if (!empty($date)) {

            $query->where('date', $date);
        }

        if (!empty($period)) {

            $query->whereBetween('date', $period);
        }

        if (!empty($keyword)) {

            $query->where('info', 'LIKE', '%' . $keyword . '%')
                ->orWhere('amount', 'LIKE', '%' . $keyword . '%')
                ->orWhere('date', 'LIKE', '%' . $keyword . '%');
        }

        return $query->get();
    }

    public function GetSUM($id, $date, $period)
    {
        $query = static::select('amount')
            ->where('user_id', $id);

        if (!empty($date)) {

            $query->where('date', 'LIKE', '%' . $date . "%");
        }

        if (!empty($period)) {

            $query->whereBetween('date', $period);
        }

        return $query->sum('amount');
    }
}
