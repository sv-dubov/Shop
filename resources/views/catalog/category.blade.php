@extends('layout.site', ['title' => $category->name])

@section('content')
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->content }}</p>
    <div class="row">
        @foreach ($category->children as $child)
            @include('catalog.partial.category', ['category' => $child])
        @endforeach
    </div>
    <div class="bg-info p-2 mb-4">
        <form method="get"
              action="{{ route('catalog.category', ['category' => $category->slug]) }}">
            @include('catalog.partial.filter')
            <a href="{{ route('catalog.category', ['category' => $category->slug]) }}"
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
