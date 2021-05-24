<h4>Popular brands</h4>
<ul>
    @foreach($items as $item)
        <li>
            <a href="{{ route('catalog.brand', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
            <span class="badge badge-dark float-right">{{ $item->products_count }}</span>
        </li>
    @endforeach
</ul>
