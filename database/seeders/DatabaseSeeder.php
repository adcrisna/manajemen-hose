<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'	=> 'Super Admin',
            'email'	=> 'superadmin@gmail.com',
            'password'	=> bcrypt('password'),
            'no_hp' => '085172116048',
            'gudang_id' => null,
            'role' => 'Super Admin',
        ]);
    }
}
