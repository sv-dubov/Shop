@extends('layout.admin', ['title' => 'View page'])

@section('content')
    <h1>View page</h1>
    <div class="row">
        <div class="col-12">
            <p><strong>Name:</strong> {{ $page->name }}</p>
            <p><strong>Slug:</strong> {{ $page->slug }}</p>
            <p><strong>Content (html)</strong></p>
            <div class="mb-4 bg-white p-1">
                @php echo nl2br(htmlspecialchars($page->content)) @endphp
            </div>
            <a href="{{ route('admin.page.edit', ['page' => $page->id]) }}"
               class="btn btn-success">
                Edit page
            </a>
            <form method="post" class="d-inline"  onsubmit="return confirm('Remove this page?')"
                  action="{{ route('admin.page.destroy', ['page' => $page->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Remove page
                </button>
            </form>
        </div>
    </div>
@endsection
