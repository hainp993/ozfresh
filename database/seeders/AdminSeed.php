<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => "System Admin",
                'email' => "admin@gmail.com",
                'password' => Hash::make('12345678'),
                'role' => 'admin'
            ],
            [
                'name' => "Employee",
                'email' => "employee@gmail.com",
                'password' => Hash::make('12345678'),
                'role' => 'employee'
            ],

        );
    }
}
