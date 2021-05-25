@extends('layout.admin', ['title' => 'Create new category'])

@section('content')
    <h1>Create new category</h1>
    <form method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') ?? '' }}">
        </div>
        <div class="form-group">
            @php
                $parent_id = old('parent_id') ?? $category->parent_id ?? 0;
            @endphp
            <select name="parent_id" class="form-control" title="Parent">
                <option value="0">Without parent</option>
                @if (count($parents))
                    @include('admin.category.partial.branch', ['items' => $parents, 'level' => -1])
                @endif
            </select>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="content" placeholder="Description" rows="3">{{ old('content') ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <input type="file" class="form-control-file" name="image" accept="image/png, image/jpeg">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
