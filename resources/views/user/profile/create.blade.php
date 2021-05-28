@extends('layout.site', ['title' => 'Create profile'])

@section('content')
    <h1>Create profile</h1>
    <form method="post" action="{{ route('user.profile.store') }}">
        @include('user.profile.partial.form')
    </form>
@endsection
