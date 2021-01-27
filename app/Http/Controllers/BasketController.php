<?php

namespace App\Http\Controllers;

use App\Helpers\Json;
use App\Models\Record;
use App\Helpers\Facade\FacadeCart;
use App\Http\Controllers\Controller;

class BasketController extends Controller
{

    public function index()
    {
    // Take the first 3 records, ordered by album title
    $records = Record::orderBy('title')->take(3)->get();
    $result = compact('records');
    Json::dump($result);
    return view('basket', $result);
    }

    public function addToCart($id)
    {
        $record = Record::findOrFail($id);
        FacadeCart::add($record);
        session()->flash('success', "The record <b>$record->title</b> from <b>$record->artist</b> has been added to your basket");
        return back();
    }

    public function deleteFromCart($id)
    {
        $record = Record::findOrFail($id);
        FacadeCart::delete($record);
        return back();
    }

    public function emptyCart()
    {
        FacadeCart::empty();
        return redirect('basket');
    }
}
