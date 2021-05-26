@extends('layout.admin', ['title' => 'Edit user'])

@section('content')
    <h1 class="mb-4">Edit user</h1>
    <form method="post" action="{{ route('admin.user.update', ['user' => $user->id]) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name, Surname" value="{{ old('name') ?? $user->name ?? '' }}">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{ old('email') ?? $user->email ?? '' }}">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="change_password" id="change_password">
            <label class="form-check-label" for="change_password">
                Change user's password
            </label>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="password" placeholder="New password" value="">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="password_confirmation" placeholder="Confirm new password" value="">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
@endsection
