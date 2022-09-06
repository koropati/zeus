<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_type',
        'device_number',
        'request',
        'expired_at',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
