<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin1',
            'email' => 'admin1@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin2',
            'email' => 'admin2@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
    }
}
