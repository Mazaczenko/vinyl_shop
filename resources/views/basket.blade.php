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
                <th class="width-50">Qty</th>
                <th class="width-80">Price</th>
                <th class="width-80"></th>
                <th>Record</th>
                <th class="width-120"></th>
            </tr>
        </thead>
        <tbody>
            @foreach(FacadeCart::getRecords() as $record)
            <tr>
                <th>{{ $record['qty'] }}</th>
                <th>€&nbsp;{{ $record['price'] }}</th>
                <th>
                    <img class="img-thumbnail cover" src="/assets/vinyl.png"
                    data-src="{{ $record['cover'] }}"
                    alt="{{ $record['title'] }}">
                </th>
                <th>
                    {{ $record['artist'] . ' - ' . $record['title']  }}
                </th>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a href="/basket/delete/{{ $record['id'] }}" class="btn btn-outline-secondary">-1</a>
                        <a href="/basket/add/{{ $record['id'] }}" class="btn btn-outline-secondary">+1</a>
                    </div>
                </td>
            </tr>
            @endforeach
            <tr>
                <th></th>
                <td>
                    </th>
                <th></th>
                <th>
                    <p><a href="/basket/empty" class="btn btn-sm btn-outline-danger">Empty your basket</a></p>
                </th>
                <th>
                    <p><b>Total</b>: €&nbsp;{{ FacadeCart::getTotalPrice() }}</p>
                    <p><a href="/user/checkout" class="btn btn-sm btn-outline-success">Checkout</a></p>
                </th>
            </tr>
        </tbody>
    </table>
</div>
@endif
@endsection

@section('script_after')
    <script>
        $(function () {
             $('.cover').each(function () {
                $(this).attr('src', $(this).data('src'));
            });
        });
    </script>
@endsection
