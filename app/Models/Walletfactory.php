<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walletfactory extends Model
{
    use HasFactory;
    protected $fillable = [
        'company',
        'random_id',
        'phone_number',
        'factory_id',
    ];
    public function factory(){
        return $this->belongsTo(Factory::class);
         }
}
