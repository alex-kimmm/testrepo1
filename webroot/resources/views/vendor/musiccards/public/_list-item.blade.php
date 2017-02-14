<li>
    <a href="{{ route($lang.'.musiccards.slug', $musiccard->slug) }}" title="{{ $musiccard->title }}">
        {!! $musiccard->title !!}
        {!! $musiccard->present()->thumb(null, 200) !!}
    </a>
</li>
