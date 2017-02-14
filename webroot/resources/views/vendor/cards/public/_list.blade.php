<ul class="list-cards">
    @foreach ($items as $card)
    @include('cards::public._list-item')
    @endforeach
</ul>
