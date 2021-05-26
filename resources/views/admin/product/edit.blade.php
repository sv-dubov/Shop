@extends('layout.admin', ['title' => 'Edit product'])

@section('content')
    <h1>Edit product</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.product.update', ['product' => $product->id]) }}">
        @method('PUT')
        @include('admin.product.partial.form')
    </form>
@endsection
