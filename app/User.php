<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Model\BankAccount;
use App\Model\Invoice;
use App\Model\Order;
use App\Model\AppPermission;


class User extends Authenticatable
{
    use HasFactory;

    use Notifiable, HasApiTokens;

    protected $fillable = [
        'user_type',
        'f_name',
        'l_name',
        'phone_no',
        'email',
        'is_phone_verified',
        'is_email_verified',
        'image',
        'password',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function appPermissions()
    {
        return $this->hasMany(AppPermission::class);
    }

    // public function isDriver()
    // {
    //     return $this->is_driver == '1';
    // }

    // public function isUser()
    // {
    //     return $this->is_driver == '0';
    // }
}
