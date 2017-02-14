<nav id="myNavmenu" class="navmenu navmenu-default navmenu-fixed-left offcanvas canvas-slid hidden-lg hidden-md" role="navigation" style="left: 0px; right: 581px;">
    <ul class="nav navmenu-nav menu">
<<<<<<< HEAD
=======
        <ul class="nav navbar-nav menu nav-fill nav-main" role="menu">

            <li id="menuitem_0" class="{{ (Request::is('/') ? 'active' : '') }}" role="menuitem">
                <a href="/" class="{{ (Request::is('/') ? 'active' : '') }}">Home
                </a>
            </li>

            <li id="menuitem_1" class="{{ (Request::is('insurance') ? 'active' : '') }}" role="menuitem">
                <a href="/insurance" class="{{ (Request::is('insurance') ? 'active' : '') }}">Insurance
                </a>
            </li>
>>>>>>> test

        <?php
        $navMenuBeginSection =
        '<li id="menuitem_0" class="'. (Request::is('/') ? 'active' : '') .'" role="menuitem">
             <a href="/" class="'. (Request::is('/') ? 'active' : '') .'">Home
             </a>
         </li>';
        ?>

<<<<<<< HEAD
        @include('menus::public._menu',
        [
            'name' => 'main-left',
            '_navMenuBeginSection' => $navMenuBeginSection,
        ]
        )
=======
            <li id="menuitem_3" class="{{ (Request::is('face-of-zz') ? 'active' : '') }}" role="menuitem">
                <a href="/face-of-zz" class="{{ (Request::is('face-of-zz') ? 'active' : '') }}">
                    Competitions
                </a>
            </li>

            <li id="menuitem_4" class="{{ (Request::is('music') ? 'active' : '') }}" role="menuitem">
                <a href="/music" class="{{ (Request::is('music') ? 'active' : '') }}">
                    Music
                </a>
            </li>

            {{--<li id="menuitem_5" class="" role="menuitem">--}}
                {{--<a href="/clothing" class="">--}}
                    {{--Clothing--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
>>>>>>> test

        <ul class="nav navbar-nav menu nav-fill nav-main">
            @if(Auth::check())
            <li id="" class="{{ (Request::is('profile/*') ? 'active' : '') }}" role="menuitem">
                <a href="/profile/my-details" class="{{ (Request::is('profile/*') ? 'active' : '') }}">
                    My Account
                </a>
            </li>
            <li id="" class="" role="menuitem">
                <a href="/auth/logout" class="">
                    Sign Out
                </a>
            </li>
            @else
            <li class="sign-in nav-fill {{ (Request::is('auth/login') ? 'active' : '') }}">
                <a style="padding:0px;" href="/auth/login" class="{{ (Request::is('auth/login') ? 'active' : '') }}">sign in</a>
            </li>
            @endif
            <li class="basket">
                <a href="/basket">
                    Basket
                    <img src="{{ asset('img/basket.png') }}" class="basket-icon pull-right">
                    <span class="label basket-counter nav-mobile-version">@if($count > 0){{ $count }}@endif</span>
                </a>
            </li>
        </ul>
    </ul>
</nav>