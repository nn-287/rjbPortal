<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Order;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'name',
        'image',
        'weight',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
