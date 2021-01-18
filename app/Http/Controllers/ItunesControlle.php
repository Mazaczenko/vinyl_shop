<?php

namespace App\Http\Controllers;

use App\Helpers\Json;
use Illuminate\Support\Facades\Http;



class ItunesControlle extends Controller
{
    public function index() {

        $response = Http::get('https://rss.itunes.apple.com/api/v1/us/itunes-music/top-songs/all/12/explicit.json')->json();
        $title = $response['feed']['title'];
        $songs = $response['feed']['results'];
        $songs = collect($songs)
            ->transform(function($item, $key){
                unset($item['id'], $item['releaseDate'], $item['collectionName'],
                    $item['kind'], $item['copyright'], $item['artistId'], $item['contentAdvisoryRating'],
                    $item['url']);
                    return $item;
            });


        $result = compact('songs');

        Json::dump($result);

        return view('excercise.index', $result);
    }
}
