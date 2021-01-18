@extends('layouts.template')

@section('title')

@section('main')

<h1>iTunes</h1>
<div class="row">
    @foreach($songs as $song)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
            <div class="card">
                <img class="card-img-top" src="{{ $song['artworkUrl100'] }}" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $song['artistName'] }}</h5>
                        <p class="card-text">{{ $song['name'] }}</p>
                    </div>
                <div class="card-footer d-flex justify-content-between">
                    <table class="table">
                        <tbody>
                            <th>{{ $song['genres'][0]['name'] }}</th>
                            <th><a href="{{ $song['artistUrl'] }}">{{ $song['artistName'] }}</a></th>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach

</div>
@endsection
<div class="float-right">

</div>
