@csrf
<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
<div class="form-group">
    <input type="text" class="form-control" name="title" placeholder="Profile title" value="{{ old('title') ?? $profile->title ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Name, Surname" value="{{ old('name') ?? $profile->name ?? '' }}">
</div>
<div class="form-group">
    <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{ old('email') ?? $profile->email ?? '' }}">
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
    <button type="submit" class="btn btn-success">Save</button>
</div>
