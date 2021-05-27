@extends('layout.site', ['title' => $brand->name])

@section('content')
    <h1>{{ $brand->name }}</h1>
    <p>{{ $brand->content }}</p>
    <h5 class="bg-info text-white p-1 mb-4">Brand's products</h5>
    <div class="row">
        @foreach ($products as $product)
            @include('catalog.partial.product', ['product' => $product])
        @endforeach
    </div>
    {{ $products->links() }}
@endsection
