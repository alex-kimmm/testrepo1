<section class="trustpilot-charity">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 trustpilot">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 trustpilot-logo col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                        <div class="trustpilot-widget" data-locale="en-GB" data-template-id="53aa8807dec7e10d38f59f32" data-businessunit-id="56f4242a0000ff00058a97cb" data-style-height="115px" data-style-width="310px" data-theme="dark">
                            <a href="https://uk.trustpilot.com/review/zugarznap.com" target="_blank">Trustpilot</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 charity trust-pilot-charity-mobile-version">
                <div class="charity-logo">
                    <a href="https://www.b1g1.com/" target="_blank"><img src="/img/b1g1.png" class="logo"></a>
                    <h3>{{ \TypiCMS\Modules\Orders\Models\Order::countOrderWithInsurances() }}</h3>
                    <p>Based on {{ \TypiCMS\Modules\Orders\Models\Order::countOrderWithInsurances() }} reviews</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">

    <div class="footer-menu">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            {!! Menus::render('footer-insurance') !!}
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            {!! Menus::render('footer-clothing') !!}
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            {!! Menus::render('footer-account') !!}
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            {!! Menus::render('footer-issues') !!}
        </div>
    </div>
</footer>
