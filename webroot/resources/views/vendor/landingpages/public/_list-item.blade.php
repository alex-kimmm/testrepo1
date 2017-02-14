<li>
    <a href="{{ route($lang.'.landingpages.slug', $landingpage->slug) }}" title="{{ $landingpage->title }}">
        {!! $landingpage->title !!}
        {!! $landingpage->present()->thumb(null, 200) !!}
    </a>
</li>
