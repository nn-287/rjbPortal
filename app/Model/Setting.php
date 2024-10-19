<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notification_sound',
        'appearance',
        'map_service',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
