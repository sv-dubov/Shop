@extends('layout.admin', ['title' => 'Edit category'])

@section('content')
    <h1>Edit category</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.category.update', ['category' => $category->id]) }}">
        @method('PUT')
        @include('admin.category.partial.form')
    </form>
@endsection
