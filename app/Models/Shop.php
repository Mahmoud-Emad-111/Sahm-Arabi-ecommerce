<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Shop extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'random_id',
        'name',
        'logo',
        'country',
        'governorate',
        'region',
        'address',
        'phone_number',
        'whatsapp_number',
        'urlStore',
        'email',
        'password',
        'workingScops',
        'description',
        'imageCard_one',
        'imageCard_two',
        'status',
    ];


        // cradit card
        public function craditshops(){
            return $this->hasMany(CreditShop::class);
        }
         // wallet
         public function walletshops(){
            return $this->hasMany(walletShop::class);
        }
          // products
          public function productsShop(){
            return $this->hasMany(Shopproduct::class);
        }



}
