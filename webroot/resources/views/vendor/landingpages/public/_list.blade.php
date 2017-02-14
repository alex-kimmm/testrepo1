<ul class="list-landingpages">
    @foreach ($items as $landingpage)
    @include('landingpages::public._list-item')
    @endforeach
</ul>
