<div class="white-div">
    <div class="col-md-6 col-sm-6">
        <div class="white-div-content">
            <div class="top-label first">
                <span class="general homepage">{{ $secondHeaderBlock->title }}</span>
            </div>

            <div class="simple-text">
                {!! $secondHeaderBlock->body !!}
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6">
        <div class="benefits-img margin-0px" style="background-image: url('{{$secondHeaderBlock->getImageUrl()}}')">
        {{--TO DO, REFACTOR BELOW BLOCK--}}
        @if(isset($showWaterBlock) && $showWaterBlock)
            <div class="top-b1g1">
                <p class="b1g1-no">{{ \TypiCMS\Modules\Orders\Models\Order::countOrderWithInsurances() }} </p>
                <p class="blue-big">WATER </p>
                <p class="blue-small">BOTTLES  FILLED</p>
                <div class="b1g1-logo"><img src="img/b1g1.png"></div>
            </div>
        @endif
        </div>
    </div>

    <div class="benefits-arrow-bottom over-cover-me">
        <a href="#b3" class="anim-anchor"><img src="img/benefits-arrow-bottom.png"></a>
    </div>
</div>