<li>
    <a href="{{ route($lang.'.cardcoverblocks.slug', $cardcoverblock->slug) }}" title="{{ $cardcoverblock->title }}">
        {!! $cardcoverblock->title !!}
        {!! $cardcoverblock->present()->thumb(null, 200) !!}
    </a>
</li>
