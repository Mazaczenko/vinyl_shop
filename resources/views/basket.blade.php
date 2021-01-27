@extends('layouts.template')

@section('title', 'Your Basket')

@section('main')
<h1>Basket</h1>
@if( FacadeCart::getTotalQty() == 0)
    <div class="alert alert-primary">
        Your basket is empty.
    </div>
@else
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Qty</th>
            <th>Price</th>
            <th></th>
            <th>Record</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach(FacadeCart::getRecords() as $record)
            <tr>
                <td>{{ $record['qty'] }}</td>
                <td>€&nbsp;{{ $record['price'] }}</td>
                <td>
                    <img class="img-thumbnail cover" src="/assets/vinyl.png"
                         data-src="{{ $record['cover'] }}"
                         alt="{{ $record['title'] }}">
                </td>
                <td>
                    {{ $record['artist'] . ' - ' . $record['title']  }}
                </td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a href="/basket/delete/{{ $record['id'] }}" class="btn btn-outline-secondary">-1</a>
                        <a href="/basket/add/{{ $record['id'] }}" class="btn btn-outline-secondary">+1</a>
                    </div>
                </td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <p><a href="/basket/empty" class="btn btn-sm btn-outline-danger">Empty your basket</a></p>
            </td>
            <td>
                <p><b>Total</b>: €&nbsp;{{ FacadeCart::getTotalPrice() }}</p>
                <p><a href="/user/checkout" class="btn btn-sm btn-outline-success">Checkout</a></p>
            </td>
        </tr>
        </tbody>
    </table>
</div>
@endif
@endsection
