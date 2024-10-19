<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Driver;
use App\Model\Order;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'driver_id',
        'pickup_time',
        'dropoff_time',
        'estimated_arrival_time',
        'location',
        'location_in_miles',
        'image',
        'signature',
    ];


    protected $casts = [
        'pickup_time' => 'datetime',
        'dropoff_time' => 'datetime',
        'estimated_arrival_time' => 'datetime',
    ];

    // public function getPickupTimeAttribute($value)
    // {
    //     return \Carbon\Carbon::parse($value)->format('H:i:s');
    // }

    // public function getDropoffTimeAttribute($value)
    // {
    //     return \Carbon\Carbon::parse($value)->format('H:i:s');
    // }

    // public function getEstimatedArrivalTimeAttribute($value)
    // {
    //     return \Carbon\Carbon::parse($value)->format('H:i:s');
    // }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
