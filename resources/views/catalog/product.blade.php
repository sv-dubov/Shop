<h1>Product: {{ $product->name }}</h1>
<p>Price: {{ number_format($product->price, 2, '.', '') }}</p>
<p>
    Category:
    <a href="{{ route('catalog.category', ['slug' => $product->category_slug]) }}">
        {{ $product->category_name }}
    </a>
</p>
<p>
    Brand:
    <a href="{{ route('catalog.brand', ['slug' => $product->brand_slug]) }}">
        {{ $product->brand_name }}
    </a>
</p>
<p>{{ $product->content }}</p>
