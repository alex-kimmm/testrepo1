<li>
    <a href="{{ route($lang.'.gradients.slug', $gradient->slug) }}" title="{{ $gradient->title }}">
        {!! $gradient->title !!}
        {!! $gradient->present()->thumb(null, 200) !!}
    </a>
</li>
