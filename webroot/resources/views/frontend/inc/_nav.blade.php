{{--<section id="main-navigation">--}}
    {{--<!-- Navigation -->--}}
    {{--<nav id="stickynav" class="navbar navbar-default navbar-landing hidden-xs" role="navigation">--}}
        {{--<div class="navbar-header">--}}
            {{--<a class="navbar-brand" href="/index">ok,  Show me</a>--}}
        {{--</div>--}}
        {{--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">--}}
            {{--{!! Menus::render('main-left') !!}--}}
            {{--{!! Menus::render('main-right') !!}--}}
        {{--</div>--}}
    {{--</nav>--}}
{{--</section>--}}


<section id="main-navigation">
    <div class="container-fluid" >
        <nav id="stickynav" class="navbar navbar-default navbar-landing hidden-xs" role="navigation" >

        <div class="row" >
            <div class="navbar-header col-sm-2">
                <a class="navbar-brand nav-fill text-center" href="/" >ok, Show me</a>
            </div>
            <div class="col-sm-8">
                    {!! Menus::render('main-left') !!}
            </div>
            <div class="col-sm-1">
                <ul class="nav navbar-nav nav-fill">
                    <?php if(Auth::check()): ?>
                        <li  class="account  nav-fill">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="account-icon account-icon-center"></span></a>
                            <ul class="dropdown-menu">
                                <div class="dropdown-arrow"></div>
                                <li><a href="/profile/my-details">My Account</a></li>
                                <li><a href="/auth/logout">Sign out</a></li>
                            </ul>
                        </li>

                    <?php else: ?>
                        <li  class="sign-in  nav-fill" ><a style="padding:0px;" href="/auth/login" class="{{ (Request::is('auth/login') ) ? ' active ': '' }}" >sign in</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-sm-1">
                <ul class="nav navbar-nav nav-fill" >
                    <?php
                        $count = \LukePOLO\LaraCart\Facades\LaraCart::count($withItemQty = false);
                    ?>
                    <li  class="basket nav-fill" ><a href="/basket" >
                        <span class="basket-icon basket-icon-center">
                            <div class="basket-counter-container">
                                <span class="label basket-counter">@if($count > 0){{$count}}@endif</span>
                            </div>
                        </span>

                    </a></li>
                </ul>
            </div>


        </div>
        </nav>
    </div>
</section>