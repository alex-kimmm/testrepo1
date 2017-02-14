<ul class="list-slideshows">
    @foreach ($items as $slideshow)
    @include('slideshows::public._list-item')
    @endforeach
</ul>
