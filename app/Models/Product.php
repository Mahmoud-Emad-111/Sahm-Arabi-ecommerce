<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [

        'random_id',
        'name',
        'price',
        'sub_description',
        'description',
        'image_array',
        'category_id',
        'shop_id',
        'factory_id'
    ];
    protected $casts = [
        'image_array' => 'array',
    ];



      //product
public function allproduct(){
    return $this->belongsTo(Category::class);
     }

      //Country
    public function Countries(){
        return $this->hasMany(Country::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function Shop(){
        return $this->belongsTo(Shop::class);
    }

    public function Product(){
        return $this->belongsTo(Product::class);
    }


}
