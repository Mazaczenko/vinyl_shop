<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Json;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // Show the complete order history
    public function index ()
    {
        $orders = Order::with(['orderlines:id,order_id,artist,title,cover,total_price,quantity', 'user:id,name,email'])
        ->select(['id','user_id','total_price','created_at'])
        ->orderByDesc('id')
        ->get();
        $result = compact('orders');
        Json::dump($result);
        return view('admin.orders.index', $result);
    }
}
