<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'message'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
