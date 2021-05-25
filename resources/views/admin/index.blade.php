@extends('layout.admin')

@section('content')
    <h1>Admin panel</h1>
    <p>Welcome, {{ auth()->user()->name }}</p>
    <p>This is admin panel.</p>
    <form action="{{ route('user.logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>
@endsection
