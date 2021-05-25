@extends('layout.admin', ['title' => 'All categories'])

@section('content')
    <h1>All categories</h1>
    <a href="{{ route('admin.category.create') }}" class="btn btn-success mb-4">
        Create category
    </a>
    <table class="table table-bordered">
        <tr>
            <th width="30%">Name</th>
            <th width="65%">Description</th>
            <th><i class="fas fa-edit"></i></th>
            <th><i class="fas fa-trash-alt"></i></th>
        </tr>
        @include('admin.category.partial.tree', ['level' => -1, 'parent' => 0])
    </table>
@endsection
