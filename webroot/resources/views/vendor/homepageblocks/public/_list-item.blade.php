<li>
    <a href="{{ route($lang.'.homepageblocks.slug', $homepageblock->slug) }}" title="{{ $homepageblock->title }}">
        {!! $homepageblock->title !!}
        {!! $homepageblock->present()->thumb(null, 200) !!}
    </a>
</li>
