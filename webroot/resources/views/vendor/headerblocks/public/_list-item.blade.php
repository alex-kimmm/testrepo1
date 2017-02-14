<li>
    <a href="{{ route($lang.'.headerblocks.slug', $headerblock->slug) }}" title="{{ $headerblock->title }}">
        {!! $headerblock->title !!}
        {!! $headerblock->present()->thumb(null, 200) !!}
    </a>
</li>
