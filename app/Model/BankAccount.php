<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name',
        'branch',
        'account_number',
        'card_type',
        'transaction_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
