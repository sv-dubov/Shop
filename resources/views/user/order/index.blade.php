@extends('layout.site', ['title' => 'Your orders'])

@section('content')
    <h1>Your orders</h1>
    @if($orders->count())
        <table class="table table-bordered">
            <tr>
                <th width="2%">№</th>
                <th width="19%">Date</th>
                <th width="13%">Status</th>
                <th width="19%">Customer</th>
                <th width="24%">E-mail</th>
                <th width="21%">Phone</th>
                <th width="2%"><i class="fas fa-eye"></i></th>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $statuses[$order->status] }}</td>
                    <td>{{ $order->name }}</td>
                    <td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                    <td>{{ $order->phone }}</td>
                    <td>
                        <a href="{{ route('user.order.show', ['order' => $order->id]) }}">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $orders->links() }}
    @else
        <p>No orders</p>
    @endif
@endsection
