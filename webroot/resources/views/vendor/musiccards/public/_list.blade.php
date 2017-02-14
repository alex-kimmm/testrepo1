<ul class="list-musiccards">
    @foreach ($items as $musiccard)
    @include('musiccards::public._list-item')
    @endforeach
</ul>
