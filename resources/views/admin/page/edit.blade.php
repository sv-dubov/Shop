@extends('layout.admin', ['title' => 'Edit page'])

@section('content')
    <h1>Edit page</h1>
    <form method="post" action="{{ route('admin.page.update', ['page' => $page->id]) }}">
        @method('PUT')
        @include('admin.page.partial.form')
    </form>
@endsection
