@csrf
<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') ?? $product->name ?? '' }}">
</div>
<div class="form-group">
    @php
        $category_id = old('category_id') ?? $product->category_id ?? 0;
    @endphp
    <select name="category_id" class="form-control" title="Category">
        <option value="0">Choose category</option>
        @if (count($items))
            @include('admin.product.partial.branch', ['level' => -1, 'parent' => 0])
        @endif
    </select>
</div>
<div class="form-group">
    @php
        $brand_id = old('brand_id') ?? $product->brand_id ?? 0;
    @endphp
    <select name="brand_id" class="form-control" title="Brand">
        <option value="0">Choose brand</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" @if ($brand->id == $brand_id) selected @endif>
                {{ $brand->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <textarea class="form-control" name="content" placeholder="Description" rows="4">{{ old('content') ?? $product->content ?? '' }}</textarea>
</div>
<div class="form-group">
    <input type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price') ?? $product->price ?? '' }}">
</div>
<div class="form-group">
    <input type="file" class="form-control-file" name="image" accept="image/png, image/jpeg">
</div>
@isset($product->image)
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" name="remove" id="remove">
        <label class="form-check-label" for="remove">
            Remove image
        </label>
    </div>
@endisset
<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
