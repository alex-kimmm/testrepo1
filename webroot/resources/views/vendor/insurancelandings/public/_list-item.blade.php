<li>
    <a href="{{ route($lang.'.insurancelandings.slug', $insurancelanding->slug) }}" title="{{ $insurancelanding->title }}">
        {!! $insurancelanding->title !!}
        {!! $insurancelanding->present()->thumb(null, 200) !!}
    </a>
</li>
