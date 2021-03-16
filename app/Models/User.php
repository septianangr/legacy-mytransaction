<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'role',
        'name',
        'email',
        'password',
        'created_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function FindData($length, $keyword)
    {
        $query = static::where('role', 2);

        if ($length != 0) {

            $query->limit($length);
        }

        if (!empty($keyword)) {

            $query->where('email', 'LIKE', '%' . $keyword . "%")
                ->orWhere('name', 'LIKE', '%' . $keyword . "%");
        }

        return $query->get();
    }
}
