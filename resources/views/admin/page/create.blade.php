@extends('layout.admin', ['title' => 'Create new page'])

@section('content')
    <h1>Create new page</h1>
    <form method="post" action="{{ route('admin.page.store') }}">
        @include('admin.page.partial.form')
    </form>
@endsection
