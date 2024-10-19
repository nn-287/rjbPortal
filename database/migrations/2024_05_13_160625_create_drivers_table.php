<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('is_phone_verified')->nullable();
            $table->string('is_email_verified')->nullable();
            $table->string('identity_image')->nullable();
            $table->string('password')->nullable();
            $table->string('identity_no')->nullable();
            $table->string('identity_type')->nullable();
            $table->string('overall_rating')->nullable();
            $table->string('long')->nullable();
            $table->string('lat')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
