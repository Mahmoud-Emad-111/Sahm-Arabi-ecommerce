<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class walletShop extends Model
{
    use HasFactory;
    protected $table = 'wallet_shops';
    protected $fillable = [
        'company',
        'random_id',
        'phone_number',
        'shop_id',
    ];

      public function Shop(){
        return $this->belongsTo(Shop::class);
         }
}
