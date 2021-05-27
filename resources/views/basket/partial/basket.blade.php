<a class="nav-link @if ($positions) text-success @endif"
   href="{{ route('basket.index') }}">
    Basket
    @if ($positions) ({{ $positions }}) @endif
</a>
