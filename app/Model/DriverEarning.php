<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Driver;

class DriverEarning extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'earning_amount',
        'tip_amount',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
