<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'random_id',
        'title',
        'delivery',
        'country_id',
    ];
    public function countries(){
        return $this->belongsTo(Country::class);
         }
}
