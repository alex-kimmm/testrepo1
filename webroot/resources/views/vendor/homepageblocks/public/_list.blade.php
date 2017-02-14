<ul class="list-homepageblocks">
    @foreach ($items as $homepageblock)
    @include('homepageblocks::public._list-item')
    @endforeach
</ul>
