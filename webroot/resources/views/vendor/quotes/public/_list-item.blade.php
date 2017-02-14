<li>
    <a href="{{ route($lang.'.quotes.slug', $quote->slug) }}" title="{{ $quote->title }}">
        {!! $quote->title !!}
        {!! $quote->present()->thumb(null, 200) !!}
    </a>
</li>
