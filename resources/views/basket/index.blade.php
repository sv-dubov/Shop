@extends('layout.site')

@section('content')
    <h1>Your basket</h1>
    @if (count($products))
        @php
            $basketCost = 0;
        @endphp
        <form action="{{ route('basket.clear') }}" method="post" class="text-right">
            @csrf
            <button type="submit" class="btn btn-outline-danger mb-4 mt-0">
                Clear basket
            </button>
        </form>
        <table class="table table-bordered">
            <tr>
                <th>№</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Cost</th>
            </tr>
            @foreach($products as $product)
                @php
                    $itemPrice = $product->price;
                    $itemQuantity = $product->pivot->quantity;
                    $itemCost = $itemPrice * $itemQuantity;
                    $basketCost = $basketCost + $itemCost;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('catalog.product', [$product->slug]) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>{{ number_format($itemPrice, 2, '.', '') }}</td>
                    <td>
                        <form action="{{ route('basket.minus', ['id' => $product->id]) }}"
                              method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="fas fa-minus-square"></i>
                            </button>
                        </form>
                        <span class="mx-1">{{ $itemQuantity }}</span>
                        <form action="{{ route('basket.plus', ['id' => $product->id]) }}"
                              method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="fas fa-plus-square"></i>
                            </button>
                        </form>
                    </td>
                    <td>{{ number_format($itemCost, 2, '.', '') }}</td>
                    <td>
                        <form action="{{ route('basket.remove', ['id' => $product->id]) }}"
                              method="post">
                            @csrf
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <th colspan="4" class="text-right">Total</th>
                <th>{{ number_format($basketCost, 2, '.', '') }}</th>
                <th></th>
            </tr>
        </table>
    @else
        <p>Your basket is empty</p>
    @endif
@endsection
