<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Master page
    public function index() {

        $records = Record::get();       // get all records
        dd($records);                   // 'dump' records collection and 'die' (stop execution)
        return view('shop.index');
    }

    // Detail page
    public function show($id) {
        
        return view('shop.show', ['id' => $id]);
    }
}
