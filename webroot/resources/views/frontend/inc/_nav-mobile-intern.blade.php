<section id="mobile-nav" class="mobile-intern-nav visible-xs">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-landing visible-xs" role="navigation">
        <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#myNavmenu" data-canvas="body">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="gry-logo"><a href="/"><img src="{{ asset('img/logo-gry.png') }}"></a></div>
        <div class="basket">
            <a href="/basket">
                <img src="{{ asset('img/basket.png') }}" class="basket-icon pull-right">
                <?php $count = \LukePOLO\LaraCart\Facades\LaraCart::count($withItemQty = false); ?>
                <span class="label basket-counter basket-counter-mobile-version">@if($count > 0) {{ $count }} @endif</span>
            </a>
        </div>
    </nav>
</section>