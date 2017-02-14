<li>
    <a href="{{ route($lang.'.sizes.slug', $size->slug) }}" title="{{ $size->title }}">
        {!! $size->title !!}
        {!! $size->present()->thumb(null, 200) !!}
    </a>
</li>
