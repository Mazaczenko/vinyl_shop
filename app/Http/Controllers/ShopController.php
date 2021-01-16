<?php

namespace App\Http\Controllers;

use App\Helpers\Json;
use App\Models\Record;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Master page
    public function index()
    {
        $records = Record::with('genre')->get();               // get all records
        foreach ($records as $record) {
            if(!$record->cover) {
                $record->cover = 'https://coverartarchive.org/release/' . $record->title_mbid . '/front-250.jpg';
            }
        }
        $result = compact('records');           // compact('records') is the same as ['records' => $records]
        Json::dump($result);                    // open http://vinyl_shop.test/shop?json
        return view('shop.index', $result);     // add $result as second parameter
    }

    // Detail page
    public function show($id) {
        
        return view('shop.show', ['id' => $id]);
    }
}
