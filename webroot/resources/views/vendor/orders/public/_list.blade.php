<ul class="list-orders">
    @foreach ($items as $order)
    @include('orders::public._list-item')
    @endforeach
</ul>
