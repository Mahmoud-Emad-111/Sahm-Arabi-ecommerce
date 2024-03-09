<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Factory extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'Factory';

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
        'sub_description',
        'imageCard_one',
        'imageCard_two',

    ];

        // cradit card factory
        public function craditFactories(){
            return $this->hasMany(Creditfactory::class);
        }
         // wallet facory
         public function walletFactores(){
            return $this->hasMany(Walletfactory::class);
        }

        // products
        public function products(){
            return $this->hasMany(Factoryproduct::class);
        }

}
