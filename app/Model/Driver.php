<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Delivery;
use App\Model\Order;
use App\Model\DriverEarning;
use App\Model\NotificationSetting;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Driver extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'f_name',
        'l_name',
        'phone_no',
        'email',
        'is_phone_verified',
        'is_email_verified',
        'identity_image',
        'password',
        'identity_no',
        'identity_type',
        'overall_rating',
        'long',
        'lat',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    public function driverEarnings()
    {
        return $this->hasMany(DriverEarning::class);
    }

    public function notificationSettings()
    {
        return $this->hasMany(NotificationSetting::class);
    }
}
