<div class="col-md-6 mb-4">
    <div class="card list-item">
        <div class="card-header">
            <h3 class="mb-0">{{ $product->name }}</h3>
        </div>
        <div class="card-body p-0">
            <img src="https://via.placeholder.com/400x120" alt="" class="img-fluid">
        </div>
        <div class="card-footer">
            <form action="{{ route('basket.add', ['id' => $product->id]) }}"
                  method="post" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">Add to basket</button>
            </form>
            <a href="{{ route('catalog.product', ['slug' => $product->slug]) }}"
               class="btn btn-dark float-right">Go to product</a>
        </div>
    </div>
</div>
