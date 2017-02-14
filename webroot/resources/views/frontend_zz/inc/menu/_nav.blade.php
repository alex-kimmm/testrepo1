@if(!(isset($_COOKIE['zugarznap-cookies-accepted']) && $_COOKIE['zugarznap-cookies-accepted'] != null))
@include('vendor.pages.public.cookie')
@endif

<?php $count = \LukePOLO\LaraCart\Facades\LaraCart::count($withItemQty = false); ?>

@include('frontend_zz.inc.menu._nav-mobile-intern1024')

<section id="main-navigation" style="position: relative;">
    <div class="container container-1024">
        <nav id="stickynav" class="navbar navbar-default navbar-landing hidden-xs" role="navigation">
            <div class="row">

                <div class="col-sm-10">

                    <div class="navbar-header navbar-header-1024 col-sm-2">
                        <a class="navbar-brand nav-fill text-center" href="/home">
                            <img src="{{ asset('img/red-logo.png') }}" class="red-logo">
                        </a>
                    </div>

                    <div class="col-sm-10">
                    {!! Menus::render('main-left') !!}
                    </div>

                </div>

                <div class="col-sm-2">
                    <ul class="nav navbar-nav navbar-right menu-right-section" style="margin-right: 0">

                        <?php if(Auth::check()): ?>
                            <li  class="account li-menu-right-section nav-fill">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="account-icon account-icon-center"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <div class="dropdown-arrow"></div>
                                    <li><a href="/profile/my-details">My Account</a></li>
                                    <li><a href="/auth/logout">Sign out</a></li>
                                </ul>
                            </li>

                        <?php else: ?>
                            <li  class="sign-in li-menu-right-section nav-fill">
                                <a style="padding:0px;" href="/auth/login" class="{{ (Request::is('auth/login') ) ? ' active ': '' }}" >sign in</a>
                            </li>
                        <?php endif; ?>


                        <li class="basket li-menu-right-section">
                            <a href="/basket">
                                <span class="basket-icon">
                                    <div class="basket-counter-container">
                                        <span class="label basket-counter">@if($count > 0){{ $count }}@endif</span>
                                    </div>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</section>