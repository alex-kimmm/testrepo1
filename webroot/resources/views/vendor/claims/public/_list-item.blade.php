<li>
    <a href="{{ route($lang.'.claims.slug', $claim->slug) }}" title="{{ $claim->title }}">
        {!! $claim->title !!}
        {!! $claim->present()->thumb(null, 200) !!}
    </a>
</li>
