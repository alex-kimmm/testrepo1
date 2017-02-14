<li>
    <a href="{{ route($lang.'.musiclandingpages.slug', $musiclandingpage->slug) }}" title="{{ $musiclandingpage->title }}">
        {!! $musiclandingpage->title !!}
        {!! $musiclandingpage->present()->thumb(null, 200) !!}
    </a>
</li>
