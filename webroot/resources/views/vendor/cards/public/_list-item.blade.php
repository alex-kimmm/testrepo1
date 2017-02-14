<li>
    <a href="{{ route($lang.'.cards.slug', $card->slug) }}" title="{{ $card->title }}">
        {!! $card->title !!}
        {!! $card->present()->thumb(null, 200) !!}
    </a>
</li>
