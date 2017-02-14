<li>
    <a href="{{ route($lang.'.faceofzzlandings.slug', $faceofzzlanding->slug) }}" title="{{ $faceofzzlanding->title }}">
        {!! $faceofzzlanding->title !!}
        {!! $faceofzzlanding->present()->thumb(null, 200) !!}
    </a>
</li>
