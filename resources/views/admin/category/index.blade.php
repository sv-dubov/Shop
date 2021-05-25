@extends('layout.admin', ['title' => 'All categories'])

@section('content')
    <h1>All categories</h1>
    <table class="table table-bordered">
        <tr>
            <th width="30%">Name</th>
            <th width="65%">Description</th>
            <th><i class="fas fa-edit"></i></th>
            <th><i class="fas fa-trash-alt"></i></th>
        </tr>
        @include('admin.category.partial.tree', ['items' => $roots, 'level' => -1])
    </table>
@endsection
