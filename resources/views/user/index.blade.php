@extends('layout.site')

@section('content')
    <h1>Cabinet</h1>
    <p>Welcome, {{ auth()->user()->name }}</p>
    <form action="{{ route('user.logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>
@endsection
