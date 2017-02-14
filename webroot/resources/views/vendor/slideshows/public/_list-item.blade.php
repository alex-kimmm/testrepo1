<li>
    <a href="{{ route($lang.'.slideshows.slug', $slideshow->slug) }}" title="{{ $slideshow->title }}">
        {!! $slideshow->title !!}
        {!! $slideshow->present()->thumb(null, 200) !!}
    </a>
</li>
