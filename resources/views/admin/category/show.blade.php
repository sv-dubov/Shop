@extends('layout.admin', ['title' => 'View category'])

@section('content')
    <h1>View category</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Name:</strong> {{ $category->name }}</p>
            <p><strong>Slug:</strong> {{ $category->slug }}</p>
            <p><strong>Description</strong></p>
            @isset($category->content)
                <p>{{ $category->content }}</p>
            @else
                <p>No description</p>
            @endisset
        </div>
        <div class="col-md-6">
            @php
                if ($category->image) {
                     $url = url('storage/catalog/category/image/' . $category->image);
                    //$url = Storage::disk('public')->url('catalog/category/image/' . $category->image);
                } else {
                     $url = url('storage/catalog/category/image/no-image.png');
                    //$url = Storage::disk('public')->url('catalog/category/image/default.jpg');
                }
            @endphp
            <img src="{{ $url }}" alt="" class="img-fluid">
        </div>
    </div>
    @if ($category->children->count())
        <p><strong>Children categories</strong></p>
        <table class="table table-bordered">
            <tr>
                <th>№</th>
                <th width="45%">Name</th>
                <th width="45%">Slug</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @foreach ($category->children as $child)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('admin.category.show', ['category' => $child->id]) }}">
                            {{ $child->name }}
                        </a>
                    </td>
                    <td>{{ $child->slug }}</td>
                    <td>
                        <a href="{{ route('admin.category.edit', ['category' => $child->id]) }}">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.category.destroy', ['category' => $child->id]) }}"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="far fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No children categories</p>
    @endif
    <form method="post"
          action="{{ route('admin.category.destroy', ['category' => $category->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            Delete category
        </button>
    </form>
@endsection
