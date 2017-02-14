<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

    <div class="gadget-cover">
        <div class="card" style="background-image: url(/img/face.jpg);">
            <h1 class="card-badge">
                <span>gadget cover</span>
            </h1>
            <div class="gadget-cover-details">

            </div>
        </div>
    </div>

    <div class="card-text">
        <div class="card">
            <div class="card-text-content link-color-red">
                @if(count($sidebar_blocks) > 0)
                    {!! $insurance_block !!}
                @endif
            </div>
        </div>
    </div>

    <div class="gadget-card">
        <div class="card" style="background-image: url(/img/gadget-card_back.jpg);">
            <img src="/img/gadget-card-plus.png" id="gadget-card-plus" />
            <h1 class="card-badge">
                <span>free znap cardr</span>
            </h1>
            <div class="card-info card-info-dark">
                <div class="open-bg-container">
                    <div class="open-bg open-bg-dark hidden-xs">
                        <a href="#" id="card-cover-open" class="dark-open btn-open">Open</a>
                    </div>
                </div>
                <div class="card-details">
                    <p class="gadget-card-price card-price-dark">
                        FREE<br>
                    </p>
                    <p class="gadget-card-title card-title-dark">awesome discounts</p>
                    <p class="gadget-card-description card-description-dark">What if 1,254 all-year discounts were gathered in a basic plastic card, and for free? </p>
                    <div class="card-like"></div>
                </div>
            </div>
        </div>
    </div>

</div>
