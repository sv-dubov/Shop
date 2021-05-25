@csrf
<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') ?? $category->name ?? '' }}">
</div>
<div class="form-group">
    @php
        $parent_id = old('parent_id') ?? $category->parent_id ?? 0;
    @endphp
    <select name="parent_id" class="form-control" title="Parent">
        <option value="0">Without parent</option>
        @if (count($items))
            @include('admin.category.partial.branch', ['level' => -1, 'parent' => 0])
        @endif
    </select>
</div>
<div class="form-group">
    <textarea class="form-control" name="content" placeholder="Description" rows="3">{{ old('content') ?? $category->content ?? '' }}</textarea>
</div>
<div class="form-group">
    <input type="file" class="form-control-file" name="image" accept="image/png, image/jpeg">
</div>
@isset($category->image)
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" name="remove" id="remove">
        <label class="form-check-label" for="remove">Remove image</label>
    </div>
@endisset
<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
