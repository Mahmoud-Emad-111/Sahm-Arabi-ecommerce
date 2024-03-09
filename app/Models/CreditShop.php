<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditShop extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'name',
        'number_card',
        'ccv',
        'date',
        'shop_id', 
    ];
    public function Shop(){
        return $this->belongsTo(Shop::class);
         }
}
