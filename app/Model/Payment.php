<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Order;
use App\Model\BankAccount;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'bank_id',
        'date',
        'description',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }
}
