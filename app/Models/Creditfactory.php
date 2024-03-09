<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creditfactory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'number_card',
        'ccv',
        'date',
        'factory_id',
    ];
    public function factorios(){
        return $this->belongsTo(Factory::class);
         }
}
