<li>
    <a href="{{ route($lang.'.pagefailzs.slug', $pagefailz->slug) }}" title="{{ $pagefailz->title }}">
        {!! $pagefailz->title !!}
        {!! $pagefailz->present()->thumb(null, 200) !!}
    </a>
</li>
