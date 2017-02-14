<ul class="list-insuranceblocks">
    @foreach ($items as $insuranceblock)
    @include('insuranceblocks::public._list-item')
    @endforeach
</ul>
