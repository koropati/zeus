<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'uuid',
        'ip_address',
        'status',
        'code',
        'data',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
