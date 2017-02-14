<ul class="list-quotes">
    @foreach ($items as $quote)
    @include('quotes::public._list-item')
    @endforeach
</ul>
