<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Master page
    public function index() {
        return view('shop.index');
    }

    // Detail page
    public function show($id) {
        return view('shop.show', ['id' => $id]);
    }
}
