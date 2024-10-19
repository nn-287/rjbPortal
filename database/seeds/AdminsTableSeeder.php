<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'f_name' => 'admin',
                'l_name' => 'admin',
                'phone' => '1234567890',
                'email' => 'admin@admin.com',
                'role' => 'super_admin',
                'password' => Hash::make('12345678'), 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
