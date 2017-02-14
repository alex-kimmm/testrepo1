<li>
    <a href="{{ route($lang.'.slideshowitems.slug', $slideshowitem->slug) }}" title="{{ $slideshowitem->title }}">
        {!! $slideshowitem->title !!}
        {!! $slideshowitem->present()->thumb(null, 200) !!}
    </a>
</li>
