<div class="col-md-4 mb-4">
    <div class="card list-item">
        <div class="card-header px-1">
            <h3 class="mb-0">{{ $brand->name }}</h3>
        </div>
        <div class="card-body p-0">
            @if ($brand->image)
                @php($url = url('storage/catalog/brand/thumb/' . $brand->image))
                <img src="{{ $url }}" class="img-fluid" alt="">
            @else
                <img src="https://via.placeholder.com/300x150" class="img-fluid" alt="">
            @endif
        </div>
        <div class="card-footer px-1">
            <a href="{{ route('catalog.brand', ['brand' => $brand->slug]) }}"
               class="btn btn-dark">Brand's products</a>
        </div>
    </div>
</div>
