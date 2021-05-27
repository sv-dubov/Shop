@csrf
<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') ?? $page->name ?? '' }}">
</div>
<div class="form-group">
    @php
        $parent_id = old('parent_id') ?? $page->parent_id ?? 0;
    @endphp
    <select name="parent_id" class="form-control" title="Parent">
        <option value="0">Without parent</option>
        @foreach($parents as $parent)
            <option value="{{ $parent->id }}" @if ($parent->id == $parent_id) selected @endif>
                {{ $parent->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <textarea class="form-control" id="editor" name="content" placeholder="Content (html)" required rows="10">{{ old('content') ?? $page->content ?? '' }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
