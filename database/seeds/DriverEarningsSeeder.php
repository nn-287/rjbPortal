<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DriverEarningsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $driverEarnings = [
            [
                'driver_id' => 1,
                'earning_amount' => 50.00,
                'tip_amount' => 5.00,
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now(),
            ],
            [
                'driver_id' => 5,
                'earning_amount' => 75.00,
                'tip_amount' => 10.00,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now(),
            ],
            [
                'driver_id' => 1,
                'earning_amount' => 100.00,
                'tip_amount' => 20.00,
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now(),
            ],
            [
                'driver_id' => 6,
                'earning_amount' => 60.00,
                'tip_amount' => 8.00,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('driver_earnings')->insert($driverEarnings);
    }
        
    
}
