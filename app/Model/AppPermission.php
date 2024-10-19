<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class AppPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'permission_1',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
