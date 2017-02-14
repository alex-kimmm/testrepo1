@if ($menu = Menus::getMenu($name))

    @if ($menu->menulinks->count())

    <ul class="nav navbar-nav nav-main-1024 menu nav-fill nav-main" role="menu">
        @if(isset($_navMenuBeginSection)){!! $_navMenuBeginSection !!}@endif
        @foreach ($menu->menulinks as $menulink)
            @if(!Auth::check() and $menulink->guest)
                @include('menus::public._item')
            @endif

            @if(Auth::check() and $menulink->logged)
                @include('menus::public._item')
            @endif
        @endforeach
    </ul>
    @endif

@endif
