<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Driver;

class NotificationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'notification_pref_1',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
