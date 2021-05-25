@extends('layout.admin', ['title' => 'Edit brand'])

@section('content')
    <h1>Edit brand</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.brand.update', ['brand' => $brand->id]) }}">
        @method('PUT')
        @include('admin.brand.partial.form')
    </form>
@endsection
