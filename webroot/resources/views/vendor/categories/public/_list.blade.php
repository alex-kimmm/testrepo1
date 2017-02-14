<ul class="list-categories">
    @foreach ($items as $category)
    @include('categories::public._list-item')
    @endforeach
</ul>
