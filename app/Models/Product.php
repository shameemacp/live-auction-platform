<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'description',
        'start_price',
        'current_price',
        'end_time',
    ];
        public function bids()
    {
        return $this->hasMany(Bid::class);
    }

}
