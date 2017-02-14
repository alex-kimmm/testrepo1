<ul class="list-insurancepages">
    @foreach ($items as $insurancepage)
    @include('insurancepages::public._list-item')
    @endforeach
</ul>
