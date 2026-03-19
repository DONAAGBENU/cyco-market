<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address', 'is_banned', 'last_login'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_banned' => 'boolean',
            'last_login' => 'datetime',
        ];
    }

    public function isAdmin()
    {
        // Comparaison insensible à la casse et aux espaces accidentels
        return is_string($this->role) && trim(strtolower($this->role)) === 'admin';
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}