<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orderline extends Model
{
    use HasFactory;

    // App/Orderline.php
    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();   // an orderline belongs to an order
    }
}
