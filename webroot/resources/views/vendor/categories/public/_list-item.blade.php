<li>
    <a href="{{ route($lang.'.categories.slug', $category->slug) }}" title="{{ $category->title }}">
        {!! $category->title !!}
        {!! $category->present()->thumb(null, 200) !!}
    </a>
</li>
