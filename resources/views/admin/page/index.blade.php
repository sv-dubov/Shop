@extends('layout.admin', ['title' => 'All pages'])

@section('content')
    <h1 class="mb-3">All pages</h1>
    <a href="{{ route('admin.page.create') }}" class="btn btn-success mb-4">
        Create new page
    </a>
    @if (count($pages))
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th width="45%">Name</th>
                <th width="45%">Slug</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @include('admin.page.partial.tree', ['level' => -1, 'parent' => 0])
        </table>
    @endif
@endsection
