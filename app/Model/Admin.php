<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'f_name',
        'l_name',
        'phone',
        'email',
        'image',
        'role',
        'password',
        'remember_token',
    ];
}
