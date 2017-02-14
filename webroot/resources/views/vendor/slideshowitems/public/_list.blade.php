<ul class="list-slideshowitems">
    @foreach ($items as $slideshowitem)
    @include('slideshowitems::public._list-item')
    @endforeach
</ul>
