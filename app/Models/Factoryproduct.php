<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factoryproduct extends Model
{
    use HasFactory;
    protected $table = 'factoryproduct';
    protected $fillable = [

        'random_id',
        'name',
        'price',
        'sub_description',
        'description',
        'image_array',
        'category_id',
        'factory_id',

    ];
    protected $casts = [
        'image_array' => 'array',
    ];



    public function Productfactory(){
        return $this->belongsTo(Factory::class);
    }
}
