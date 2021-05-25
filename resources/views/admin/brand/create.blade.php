@extends('layout.admin', ['title' => 'Create new brand'])

@section('content')
    <h1>Create new brand</h1>
    <form method="post" action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
        @include('admin.brand.partial.form')
    </form>
@endsection
