<h1>Brand: {{ $brand->name }}</h1>
<ul>
    @foreach ($products as $product)
        <li>
            <a href="{{ route('catalog.product', ['slug' => $product->slug]) }}">
                {{ $product->name }}
            </a>
        </li>
    @endforeach
</ul>
