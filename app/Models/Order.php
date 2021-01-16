<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

        // App/Order.php
    public function user() 
    {
        return $this->belongsTo(User::class)->withDefault();   // an order belongs to a user
    }
}
