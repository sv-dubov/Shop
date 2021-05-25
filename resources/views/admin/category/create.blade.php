@extends('layout.admin', ['title' => 'Create new category'])

@section('content')
    <h1>Create new category</h1>
    <form method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
        @include('admin.category.partial.form')
    </form>
@endsection
