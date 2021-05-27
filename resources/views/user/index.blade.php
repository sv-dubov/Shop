@extends('layout.site', ['title' => 'Personal cabinet'])

@section('content')
    <h1>Personal cabinet</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>
    <ul>
        <li><a href="{{ route('user.profile.index') }}">Your profiles</a></li>
        <li><a href="{{ route('user.order.index') }}">Your orders</a></li>
    </ul>
    <form action="{{ route('user.logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>
@endsection
