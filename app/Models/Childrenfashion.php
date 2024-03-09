<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childrenfashion extends Model
{
    use HasFactory;
    protected $fillable = [
        'random_id',
        'name',
        'image',
    ];
}
