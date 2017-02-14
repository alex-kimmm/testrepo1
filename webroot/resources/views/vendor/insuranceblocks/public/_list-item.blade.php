<li>
    <a href="{{ route($lang.'.insuranceblocks.slug', $insuranceblock->slug) }}" title="{{ $insuranceblock->title }}">
        {!! $insuranceblock->title !!}
        {!! $insuranceblock->present()->thumb(null, 200) !!}
    </a>
</li>
