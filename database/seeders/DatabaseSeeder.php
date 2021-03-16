<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrator
        DB::table('users')->insert([
            'role' => 1,
            'name' => "Administrator",
            'email' => "admin@example.com",
            'password' => Hash::make('@admin123'),
        ]);

        // User
        DB::table('users')->insert([
            'role' => 2,
            'name' => "User",
            'email' => "user@example.com",
            'password' => Hash::make('@user123'),
        ]);
        
        DB::table('settings')->insert([
            'site_name' => "MyNote App",
            'site_icon' => "default.png",
            'registration' => 1,
        ]);
    }
}
