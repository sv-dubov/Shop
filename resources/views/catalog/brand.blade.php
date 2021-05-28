@extends('layout.site', ['title' => $brand->name])

@section('content')
    <h1>{{ $brand->name }}</h1>
    <p>{{ $brand->content }}</p>
    <div class="bg-info p-2 mb-4">
        <form method="get"
              action="{{ route('catalog.brand', ['brand' => $brand->slug]) }}">
            @include('catalog.partial.filter')
            <a href="{{ route('catalog.brand', ['brand' => $brand->slug]) }}"
               class="btn btn-light">Reset</a>
        </form>
    </div>
    <div class="row">
        @foreach ($products as $product)
            @include('catalog.partial.product', ['product' => $product])
        @endforeach
    </div>
    {{ $products->links() }}
@endsection
