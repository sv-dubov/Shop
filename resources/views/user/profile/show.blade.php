@extends('layout.site', ['title' => 'Profile info'])

@section('content')
    <h1>Profile info</h1>
    <p><strong>Profile title:</strong> {{ $profile->title }}</p>
    <p><strong>Name, Surname:</strong> {{ $profile->name }}</p>
    <p>
        <strong>E-mail:</strong>
        <a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a>
    </p>
    <p><strong>Phone:</strong> {{ $profile->phone }}</p>
    <p><strong>Delivery address:</strong> {{ $profile->address }}</p>
    @isset ($profile->comment)
        <p><strong>Comment:</strong> {{ $profile->comment }}</p>
    @endisset
    <a href="{{ route('user.profile.edit', ['profile' => $profile->id]) }}"
       class="btn btn-success">
        Edit profile
    </a>
    <form method="post" class="d-inline" onsubmit="return confirm('Remove this profile?')"
          action="{{ route('user.profile.destroy', ['profile' => $profile->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            Remove profile
        </button>
    </form>
@endsection
