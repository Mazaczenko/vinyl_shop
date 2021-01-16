<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{
    use HasFactory;

        // App/Orderline.php
    public function order() 
    {
        return $this->belongsTo(Order::class)->withDefault();   // an orderline belongs to an order
    }
}
