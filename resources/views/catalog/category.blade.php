@extends('layout.site', ['title' => $category->name])

@section('content')
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->content }}</p>
    <div class="row">
        @foreach ($category->children as $child)
            @include('catalog.partial.category', ['category' => $child])
        @endforeach
    </div>
    <h5 class="bg-info text-white p-2 mb-4">Category's products</h5>
    <div class="row">
        @foreach ($products as $product)
            @include('catalog.partial.product', ['product' => $product])
        @endforeach
    </div>
    {{ $products->links() }}
@endsection
