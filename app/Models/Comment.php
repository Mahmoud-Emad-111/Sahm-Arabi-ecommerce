<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'random_id',
        'comment',
        'rating',
        'user_id'

    ];
    public function user(){
        return $this->belongsTo(User::class);
         }



    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
