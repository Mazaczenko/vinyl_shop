<?php

namespace App\Models;

use App\Models\User;
use App\Models\Orderline;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

        // App/Order.php
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();   // an order belongs to a user
    }

    public function orderlines()
    {
      return $this->hasMany(Orderline::class);   // an order has many orderlines
    }
}
