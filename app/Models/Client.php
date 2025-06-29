<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Auth\Client as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    //
    use HasFactory, Notifiable;

    protected $guard = 'client'; // <- útil para usares um guard específico

    protected $fillable = [
        'name',
        'email',
        'password',
        'aproved',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
