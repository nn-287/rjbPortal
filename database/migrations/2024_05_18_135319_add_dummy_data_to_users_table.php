<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->insert([
            [
                'f_name' => 'John',
                'l_name' => 'Doe',
                'phone_no' => '1234567890',
                'email' => 'john.doe@example.com',
                'is_phone_verified' => '1',
                'is_email_verified' => '1',
                'image' => 'john_doe.jpg',
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'f_name' => 'Jane',
                'l_name' => 'Smith',
                'phone_no' => '0987654321',
                'email' => 'jane.smith@example.com',
                'is_phone_verified' => '0',
                'is_email_verified' => '0',
                'image' => 'jane_smith.jpg',
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
