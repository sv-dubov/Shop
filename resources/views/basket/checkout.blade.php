@extends('layout.site', ['title' => 'Make order'])

@section('content')
    <h1 class="mb-4">Make order</h1>
    @if ($profiles && $profiles->count())
        @include('basket.select', ['current' => $profile->id ?? 0])
    @endif
    <form method="post" action="{{ route('basket.saveorder') }}">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name, Surname" value="{{ old('name') ?? $profile->name ?? '' }}">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="e-mail" value="{{ old('email') ?? $profile->email ?? '' }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ old('phone') ?? $profile->phone ?? '' }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="address" placeholder="Delivery address" value="{{ old('address') ?? $profile->address ?? '' }}">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="comment" placeholder="Comment" maxlength="255" rows="2">{{ old('comment') ?? $profile->comment ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Confirm</button>
        </div>
    </form>
@endsection
