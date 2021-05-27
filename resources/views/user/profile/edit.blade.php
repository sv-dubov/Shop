@extends('layout.site', ['title' => 'Edit profile'])

@section('content')
    <h1>Edit profile</h1>
    <form method="post" action="{{ route('user.profile.update', ['profile' => $profile->id]) }}">
        @method('PUT')
        @include('user.profile.partial.form')
    </form>
@endsection
