<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'otp_code',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'otp_code',
    ];

    protected function casts(): array
    {
        return [
            'otp_expires_at' => 'datetime',
            'password'       => 'hashed',
        ];
    }
}
