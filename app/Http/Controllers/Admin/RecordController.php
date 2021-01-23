<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Json;
use App\Models\Genre;
use App\Models\Record;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('admin/records/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            // We need a list of genres inside the form
        $genres = Genre::select(['id', 'name'])->orderBy('name')->get();
        // To avoid errors with the 'old values' inside the form, we have to send an empty Record object to the view
        $record = new Record();
        $result = compact('genres', 'record');
        Json::dump($result);
        return view('admin.records.create', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'artist' => 'required',
            'title' => 'required',
            'title_mbid' => 'required|size:36|unique:records,title_mbid',
            'genre_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ], [
             'title_mbid.required' => 'The Title MusicBrainz ID is required.',
             'title_mbid.size' => 'The Title MusicBrainz ID must be :size characters.',
             'title_mbid.unique' => 'This record already exists!',
             'genre_id.required' => 'Please select a genre.',
         ]);

        $record = new Record();
        $record->artist = $request->artist;
        $record->title = $request->title;
        $record->title_mbid = $request->title_mbid;
        $record->cover = $request->cover;
        $record->price = $request->price;
        $record->stock = $request->stock;
        $record->genre_id = $request->genre_id;
        $record->save();
        // Go to the public detail page for the newly created record
        session()->flash('success', "The record <b>$record->title</b> from <b>$record->artist</b> has been added");
        return redirect("/shop/$record->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        return redirect("shop/$record->id");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        $genres = Genre::select(['id', 'name'])->orderBy('name')->get();
        $result = compact('genres', 'record');
        Json::dump($result);
        return view('admin.records.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        $this->validate($request, [
            'artist' => 'required',
            'title' => 'required',
            'title_mbid' => 'required|size:36|unique:records,title_mbid,' . $record->id,
            'genre_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ], [
            'title_mbid.required' => 'The Title MusicBrainz ID is required.',
            'title_mbid.size' => 'The Title MusicBrainz ID must be :size characters.',
            'title_mbid.unique' => 'This record already exists!',
            'genre_id.required' => 'Please select a genre.',
        ]);

        $record->artist = $request->artist;
        $record->title = $request->title;
        $record->title_mbid = $request->title_mbid;
        $record->cover = $request->cover;
        $record->price = $request->price;
        $record->stock = $request->stock;
        $record->genre_id = $request->genre_id;
        $record->save();
        // Go to the public detail page for the updated record
        session()->flash('success', "The record <b>$record->title</b> from <b>$record->artist</b> has been updated");
        return redirect("/shop/$record->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        $record->delete();
        return response()->json([
            'type' => 'success',
            'text' => "Record has been deleted"
        ]);
    }
}
