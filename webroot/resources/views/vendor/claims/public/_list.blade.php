<ul class="list-claims">
    @foreach ($items as $claim)
    @include('claims::public._list-item')
    @endforeach
</ul>
