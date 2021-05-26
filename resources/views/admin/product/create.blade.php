@extends('layout.admin', ['title' => 'Create product'])

@section('content')
    <h1>Create new product</h1>
    <form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
        @include('admin.product.partial.form')
    </form>
@endsection
