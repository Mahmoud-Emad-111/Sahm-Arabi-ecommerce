<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopproduct extends Model
{
    use HasFactory;
 protected $table = 'shopproduct';
    protected $fillable = [

        'random_id',
        'name',
        'price',
        'sub_description',
        'description',
        'image_array',
        'category_id',
        'shop_id',

    ];
    protected $casts = [
        'image_array' => 'array',
    ];



    public function Productshop(){
        return $this->belongsTo(Shop::class);
    }
}
