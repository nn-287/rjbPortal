<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;
use App\Model\Delivery;
use App\Model\Payment;
use App\Model\Invoice;
use App\Model\Driver;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'user_id',
        'address',
        'requested_items',
        'order_title',
        'driver_lat',
        'driver_long',
        'fees',
        'additional_tips',
        'is_paid',
        'payment_status',
        'order_volume',
        'payment_method',
        'comment',
        'invoice_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
