@extends('layout.admin', ['title' => 'View brand'])

@section('content')
    <h1>View brand</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Name:</strong> {{ $brand->name }}</p>
            <p><strong>Slug:</strong> {{ $brand->slug }}</p>
            <p><strong>Description</strong></p>
            @isset($brand->content)
                <p>{{ $brand->content }}</p>
            @else
                <p>No description</p>
            @endisset
        </div>
        <div class="col-md-6">
            @php
                if ($brand->image) {
                    $url = url('storage/catalog/brand/source/' . $brand->image);
                    //$url = Storage::disk('public')->url('catalog/brand/image/' . $brand->image);
                } else {
                    $url = url('storage/catalog/category/image/no-image.png');
                    //$url = Storage::disk('public')->url('catalog/brand/image/default.jpg');
                }
            @endphp
            <img src="{{ $url }}" alt="" class="img-fluid">
        </div>
    </div>
    <a href="{{ route('admin.brand.edit', ['brand' => $brand->id]) }}"
       class="btn btn-success">
        Edit brand
    </a>
    <form method="post" class="d-inline"
          action="{{ route('admin.brand.destroy', ['brand' => $brand->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            Delete brand
        </button>
    </form>
@endsection
