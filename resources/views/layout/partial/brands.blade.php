<h4>Popular brands</h4>
<ul id="brands-popular">
    @foreach($items as $item)
        <li>
            <a href="{{ route('catalog.brand', [$item->slug]) }}">{{ $item->name }}</a>
            <span class="badge badge-dark float-right">{{ $item->products_count }}</span>
        </li>
    @endforeach
</ul>
