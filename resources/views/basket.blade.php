@extends('layouts.template')

@section('title', 'Your Basket')

@section('main')
    <h1>Basket</h1>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Artist - Album</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($records as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->artist }} - {{ $record->title }}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a href="/basket/add/{{ $record->id }}" class="btn btn-outline-success">+1</a>
                        <a href="/basket/delete/{{ $record->id }}" class="btn btn-outline-danger">-1</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/basket/empty" class="btn btn-sm btn-outline-danger">Empty basket</a>

    <h2 class="mt-5">What's inside my basket?</h2>
    <hr>
    <h4>FacadeCart::getCart():</h4>
    <pre>{{ json_encode(FacadeCart::getCart(), JSON_PRETTY_PRINT) }}</pre>
    <hr>
    <h4>FacadeCart::getRecords():</h4>
    <pre>{{ json_encode(FacadeCart::getRecords(), JSON_PRETTY_PRINT) }}</pre>
    <hr>
    <h4>FacadeCart::getOneRecord(6):</h4>
    <pre>{{ json_encode(FacadeCart::getOneRecord(6), JSON_PRETTY_PRINT) }}</pre>
    <hr>
    <p><b>FacadeCart::getKeys()</b>: {{ json_encode(FacadeCart::getKeys()) }}</p>
    <p><b>FacadeCart::getTotalPrice()</b>: {{ json_encode(FacadeCart::getTotalPrice()) }}</p>
    <p><b>FacadeCart::getTotalQty()</b>: {{ json_encode(FacadeCart::getTotalQty()) }}</p>
@endsection
