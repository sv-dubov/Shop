@extends('layout.site')

@section('content')
    <h1>The order was placed</h1>
    <p>Our manager will contact you soon.</p>
    <h2>Your order</h2>
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
    <h2>Your data</h2>
    <p>Name, Surname: {{ $order->name }}</p>
    <p>E-mail: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
    <p>Phone: {{ $order->phone }}</p>
    <p>Delivery address: {{ $order->address }}</p>
    @isset ($order->comment)
        <p>Comment: {{ $order->comment }}</p>
    @endisset
@endsection
