<li>
    <a href="{{ route($lang.'.orders.slug', $order->slug) }}" title="{{ $order->title }}">
        {!! $order->title !!}
        {!! $order->present()->thumb(null, 200) !!}
    </a>
</li>
