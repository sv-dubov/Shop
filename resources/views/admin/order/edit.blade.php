@extends('layout.admin', ['title' => 'Edit order'])

@section('content')
    <h1 class="mb-4">Edit order</h1>
    <form method="post" action="{{ route('admin.order.update', ['order' => $order->id]) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            @php $status = old('status') ?? $order->status ?? 0) @endphp
            <select name="status" class="form-control" title="Order's status">
                @foreach ($statuses as $key => $value)
                    <option value="{{ $key }}" @if ($key == $status) selected @endif>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name, Surname" value="{{ old('name') ?? $order->name ?? '' }}">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{ old('email') ?? $order->email ?? '' }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ old('phone') ?? $order->phone ?? '' }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="address" placeholder="Delivery address" value="{{ old('address') ?? $order->address ?? '' }}">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="comment" placeholder="Comment" rows="2">{{ old('comment') ?? $order->comment ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
@endsection
