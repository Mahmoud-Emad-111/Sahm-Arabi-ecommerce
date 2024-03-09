<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'random_id',
        'title',
        'logo',
        'product_id'
    ];
     //Governorat
 public function governorates(){
    return $this->hasMany(Governorate::class);
}

    //product
     public function product(){
        return $this->belongsTo(Product::class);
         }
}
