@extends('layout.admin', ['title' => 'All users'])

@section('content')
    <h1 class="mb-4">All users</h1>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th width="25%">Date of registration</th>
            <th width="25%">Name, Surname</th>
            <th width="25%">E-mail</th>
            <th width="20%">Number of orders</th>
            <th><i class="fas fa-edit"></i></th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                <td>{{ $user->name }}</td>
                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                {{--<td>{{ $user->orders->count() }}</td>--}}
                <td>Change, when users will have orders</td>
                <td>
                    <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
@endsection
