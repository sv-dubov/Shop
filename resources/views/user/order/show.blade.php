@extends('layout.site', ['title' => 'Просмотр заказа'])

@section('content')
    <h1>Info order № {{ $order->id }}</h1>
    <p>СOrder's status: {{ $statuses[$order->status] }}</p>
    <h3 class="mb-3">Order details</h3>
    <table class="table table-bordered">
        <tr>
            <th>№</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Cost</th>
        </tr>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ number_format($item->price, 2, '.', '') }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->cost, 2, '.', '') }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="4" class="text-right">Total</th>
            <th>{{ number_format($order->amount, 2, '.', '') }}</th>
        </tr>
    </table>
    <h3 class="mb-3">Customer's info</h3>
    <p>Name, Surname: {{ $order->name }}</p>
    <p>E-mail: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
    <p>Phone: {{ $order->phone }}</p>
    <p>Delivery address: {{ $order->address }}</p>
    @isset ($order->comment)
        <p>Comment: {{ $order->comment }}</p>
    @endisset
@endsection
