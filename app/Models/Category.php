<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'random_id',
        'name',
        'image',
    ];

            // category
public function categories(){
    return $this->hasMany(Product::class);
}

}
