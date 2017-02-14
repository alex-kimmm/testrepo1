<li>
    <a href="{{ route($lang.'.failzs.slug', $failz->slug) }}" title="{{ $failz->title }}">
        {!! $failz->title !!}
        {!! $failz->present()->thumb(null, 200) !!}
    </a>
</li>
