@if(!(isset($_COOKIE['zugarznap-cookies-accepted']) && $_COOKIE['zugarznap-cookies-accepted'] != null))
@include('vendor.pages.public.cookie')
@endif

<nav id="myNavmenu" class="navmenu navmenu-default navmenu-fixed-left offcanvas " role="navigation">
    <ul class="nav navmenu-nav menu">

        {!! Menus::render('main-left') !!}
        <ul class="nav navbar-nav menu nav-fill nav-main">
            <?php if(Auth::check()): ?>
            <li><a href="/profile/my-details">My Account</a></li>
            <li><a href="/auth/logout">Sign out</a></li>
            <?php else: ?>
            <li  class="sign-in  nav-fill" ><a style="padding:0px;" href="/auth/login" class="{{ (Request::is('auth/login') ) ? ' active ': '' }}" >sign in</a></li>
            <?php endif; ?>
            <li class="basket"><a href="/basket">Basket<img src="{{ asset('img/basket.png') }}" class="basket-icon pull-right"></a></li>
        </ul>

    </ul>
</nav>
