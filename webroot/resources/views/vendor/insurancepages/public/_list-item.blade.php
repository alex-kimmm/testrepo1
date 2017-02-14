<li>
    <a href="{{ route($lang.'.insurancepages.slug', $insurancepage->slug) }}" title="{{ $insurancepage->title }}">
        {!! $insurancepage->title !!}
        {!! $insurancepage->present()->thumb(null, 200) !!}
    </a>
</li>
