<section id="mobile-nav" class="mobile-intern-nav new1024 visible-xs">
    <div class="container container-1024">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-landing visible-xs" role="navigation">
            <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#myNavmenu" data-canvas="body">
                {{--<span class="sr-only">Toggle navigation</span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
            </button>
            <div class="gry-logo"><a href="/home"><img src="{{ asset('img/red-logo.png') }}"></a></div>
            <div class="basket basket1024">
                <a href="/basket">
                    <span class="basket-icon">
                        <span class="label basket-counter">@if($count > 0){{ $count }}@endif</span>
                    </span>
                </a>
            </div>
        </nav>
    </div>
</section>

@include('frontend_zz.inc.menu._nav-left')