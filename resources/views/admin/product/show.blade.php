@extends('layout.admin', ['title' => 'View product'])

@section('content')
    <h1>View product</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Name:</strong> {{ $product->name }}</p>
            <p><strong>Slug:</strong> {{ $product->slug }}</p>
            <p><strong>Brand:</strong> {{ $product->brand->name }}</p>
            <p><strong>Category:</strong> {{ $product->category->name }}</p>
            <p><strong>Price:</strong> {{ $product->price }}</p>
        </div>
        <div class="col-md-6">
            @php
                if ($product->image) {
                    $url = url('storage/catalog/product/image/' . $product->image);
                } else {
                    $url = url('storage/catalog/product/image/default.jpg');
                }
            @endphp
            <img src="{{ $url }}" alt="" class="img-fluid">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p><strong>Description</strong></p>
            @isset($product->content)
                <p>{{ $product->content }}</p>
            @else
                <p>No description</p>
            @endisset
            <a href="{{ route('admin.product.edit', ['product' => $product->id]) }}"
               class="btn btn-success">
                Edit product
            </a>
            <form method="post" class="d-inline" onsubmit="return confirm('Delete this product?')"
                  action="{{ route('admin.product.destroy', ['product' => $product->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Delete product
                </button>
            </form>
        </div>
    </div>
@endsection
