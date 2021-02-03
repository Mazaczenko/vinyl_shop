<?php

namespace App\Http\Controllers;

use App\Helpers\Json;
use App\Models\Genre;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helpers\Facade\FacadeCart;

class ShopController extends Controller
{
    // Master page
    public function index(Request $request)
    {
        $genre_id = $request->input('genre_id') ?? '%';                     // OR $genre_id = $request->genre_id ?? '%';
        $artist_title = '%' . $request->input('artist') . '%';              // OR $artist_title = '%' . $request->artist . '%';
        $records = Record::with('genre')
            ->where(function ($query) use ($artist_title, $genre_id) {
                $query->where('artist', 'like', $artist_title)
                    ->where('genre_id', 'like', $genre_id);
            })
            ->orWhere(function ($query) use ($artist_title, $genre_id) {
                $query->where('title', 'like', $artist_title)
                    ->where('genre_id', 'like', $genre_id);
            })
            ->paginate(12)                         // get all records
            ->appends(['artist'=> $request->input('artist'), 'genre_id' => $request->input('genre_id')]);
        foreach ($records as $record) {
            if(!$record->cover) {
                $record->cover = 'https://coverartarchive.org/release/' . $record->title_mbid . '/front-250.jpg';
            }
        }

        $genres = Genre::orderBy('name')
            ->has('records')                        // only genres that have one or more records
            ->withCount('records')                  // add a new property 'records_count' to the Genre models/objects
            ->get()
            ->transform(function ($item, $key) {
                // Set first letter of name to uppercase and add the counter
                $item->name = ucfirst($item->name) . ' (' . $item->records_count . ')';
                // Remove all fields that you don't use inside the view
                unset($item->created_at, $item->updated_at, $item->records_count);
                return $item;
            });

        $result = compact('genres', 'records');     // $result = ['genres' => $genres, 'records' => $records]

        Json::dump($result);                        // open http://vinyl_shop.test/shop?json
        return view('shop.index', $result);         // add $result as second parameter
    }

    // Detail page
    public function show($id) {

        $record = Record::with('genre')->findOrFail($id);
        // dd($record);

        // Real path to cover image
        $record->cover = $record->cover ?? "https://coverartarchive.org/release/$record->title_mbid/front-250.jpg";

        // Combine artist + title
        $record->title = $record->artist . ' - ' . $record->title;
        // Links to MusicBrainz API (used by jQuery)

        // https://wiki.musicbrainz.org/Development/JSON_Web_Service
        $record->recordUrl = 'https://musicbrainz.org/ws/2/release/' . $record->title_mbid . '?inc=recordings+url-rels&fmt=json';

        // If stock > 0: button is green, otherwise the button is red
        $record->btnClass = $record->stock > 0 && FacadeCart::isInStock($record)? 'btn-outline-success' : 'btn-outline-danger';

        $record->genreName = $record->genre->name;

        // Remove attributes you don't need for the view
        unset($record->genre_id, $record->artist, $record->created_at, $record->updated_at, $record->title_mbid, $record->genre);

        // get record info and convert it to json
        $response = Http::get($record->recordUrl)->json();

        $tracks = $response['media'][0]['tracks'];

        $tracks = collect($tracks)
            ->transform(function ($item, $key) {
                $item['length'] = gmdate('i:s', $item['length']/1000);      // PHP works with sec, not ms!!!
                unset($item['id'], $item['recording'], $item['number']);
                return $item;
            });

        $result = compact('tracks', 'record');
        Json::dump($result);
        return view('shop.show', $result);  // Pass $result to the view
    }
}
