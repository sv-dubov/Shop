@extends('layout.site', ['title' => 'Your basket'])

@section('content')
    <h1>Your basket</h1>
    @if (count($products))
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
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('catalog.product', [$product->slug]) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>{{ number_format($product->price, 2, '.', '') }}</td>
                    <td>
                        <form action="{{ route('basket.minus', ['id' => $product->id]) }}"
                              method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="fas fa-minus-square"></i>
                            </button>
                        </form>
                        <span class="mx-1">{{ $product->pivot->quantity }}</span>
                        <form action="{{ route('basket.plus', ['id' => $product->id]) }}"
                              method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="fas fa-plus-square"></i>
                            </button>
                        </form>
                    </td>
                    <td>{{ number_format($product->price * $product->pivot->quantity, 2, '.', '') }}</td>
                    <td>
                        <form action="{{ route('basket.remove', ['id' => $product->id]) }}" method="post">
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
                <th>{{ number_format($amount, 2, '.', '') }}</th>
                <th></th>
            </tr>
        </table>
        <a href="{{ route('basket.checkout') }}" class="btn btn-success float-right">
            Make order
        </a>
    @else
        <p>Your basket is empty</p>
    @endif
@endsection
