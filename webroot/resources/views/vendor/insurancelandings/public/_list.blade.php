<ul class="list-insurancelandings">
    @foreach ($items as $insurancelanding)
    @include('insurancelandings::public._list-item')
    @endforeach
</ul>
