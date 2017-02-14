<li>
    <a href="{{ route($lang.'.usertitles.slug', $usertitle->slug) }}" title="{{ $usertitle->title }}">
        {!! $usertitle->title !!}
        {!! $usertitle->present()->thumb(null, 200) !!}
    </a>
</li>
