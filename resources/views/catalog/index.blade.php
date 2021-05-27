@extends('layout.site', ['title' => 'Products catalog'])

@section('content')
    <h1>Products catalog</h1>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque ducimus, eligendi exercitationem expedita,
        iure iusto laborum magnam qui quidem repellat similique tempora tempore ullam! Deserunt doloremque impedit
        quis repudiandae voluptas.
    </p>
    <h2 class="mb-4">Categories</h2>
    <div class="row">
        @foreach ($roots as $root)
            @include('catalog.partial.category', ['category' => $root])
        @endforeach
    </div>
    <h2 class="mb-4">Popular brands</h2>
    <div class="row">
        @foreach ($brands as $brand)
            @include('catalog.partial.brand', ['brand' => $brand])
        @endforeach
    </div>
@endsection
