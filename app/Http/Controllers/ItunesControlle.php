<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ItunesControlle extends Controller
{
    public function index() {
        $response = Http::get('https://rss.itunes.apple.com/api/v1/be/apple-music/top-songs/all/12/explicit.json');

        return view('excercise.index', $response);
    }
}
