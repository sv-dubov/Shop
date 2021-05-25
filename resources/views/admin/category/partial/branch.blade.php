@php $level++ @endphp
@foreach($items as $item)
    <option value="{{ $item->id }}">
        @if ($level) {!! str_repeat('&nbsp;&nbsp;&nbsp;', $level) !!}  @endif {{ $item->name }}
    </option>
    @if ($item->children->count())
        @include('admin.category.partial.branch', ['items' => $item->children, 'level' => $level])
    @endif
@endforeach
