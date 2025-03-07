<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRole extends Model
{
    // use HasFactory;
    protected $casts = [
        'admin_id' => 'integer',
        'orders' => 'integer',
        'products' => 'integer',
        'business_section' => 'integer',
        'nutrition' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
