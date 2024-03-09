<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    protected $guard = 'admin';
    protected $fillable = [
        'Fullname',
        'phone_number',
        'email',
        'password',
    ];

}
