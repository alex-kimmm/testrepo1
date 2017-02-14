@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.ZugarZnap'))

@section('main')

@include('frontend_zz.inc._page_header_block', ['headerBlock'=>$homePageLanding->headerBlock])

@include('frontend_zz.inc.blocks._get_me_covered')

@if( !is_null($benefitBlock1 = $homePageLanding->homePageBlocks->get(0)))
    @include('frontend_zz.inc.blocks._benefit_block', ['homePageBlock'=>$benefitBlock1, 'anchor' => 'b21', 'anchorTo' => '#b3'])
@endif

<<<<<<< HEAD
<section class="all-benefits insurance-all-benefits">
    <div class="container container-1024">
        <div class="row benefits-content padding-top-bottom-0px">

            @if(count($insuranceLanding->coverCardBlocks) > 0)
            <div id="b3" class="nav-points no-padding-top">
                <span>Cover my...</span>
            </div>

            <div class="row cover-me">
                @foreach($insuranceLanding->coverCardBlocks as $index => $coverCard)
                @if($coverCard->button_link != null)
                @include('frontend_zz.inc.cards._cover-card', [ 'position' => (($index > 0 && $index % 2 != 0) ? 'right' : 'left'), 'coverCard' => $coverCard ])
                @endif
                @endforeach
            </div>
            @endif

            <div class="benefits-arrow-bottom cover-my-arrow-bottom">
                <a href="#b4" class="anim-anchor"><img src="img/benefits-arrow-bottom.png"></a>
            </div>
        </div>
    </div>
</section>

@if( !is_null($benefitBlock2 = $homePageLanding->homePageBlocks->get(1)))
    @include('frontend_zz.inc.blocks._benefit_block', ['homePageBlock'=>$benefitBlock2, 'anchor' => 'b4', 'anchorTo' => '#b5', 'anchorMobileTo' => '#b51'])
=======
@if( !is_null($benefitBlock2 = $homePageLanding->homePageBlocks->get(1)))
    @include('frontend_zz.inc.blocks._benefit_block', ['homePageBlock'=>$benefitBlock2, 'anchor' => 'b3', 'anchorTo' => '#b4'])
>>>>>>> test
@endif

<section class="all-benefits insurance-all-benefits">
    <div class="container container-1024">
        <div class="row benefits-content padding-top-bottom-0px">

            @if(count($insuranceLanding->coverCardBlocks) > 0)
            <div id="b4" class="nav-points no-padding-top">
                <span>Cover my</span>
            </div>

            <div class="row cover-me">
                @foreach($insuranceLanding->coverCardBlocks as $index => $coverCard)
                @if($coverCard->button_link != null)
                @include('frontend_zz.inc.cards._cover-card', [ 'position' => (($index > 0 && $index % 2 != 0) ? 'right' : 'left'), 'coverCard' => $coverCard ])
                @endif
                @endforeach
            </div>
            @endif

            <div class="benefits-arrow-bottom cover-my-arrow-bottom">
                <a href="#b5" class="anim-anchor hidden-xs hidden-sm"><img src="img/benefits-arrow-bottom.png"></a>
                <a href="#b51" class="anim-anchor hidden-md hidden-lg"><img src="img/benefits-arrow-bottom.png"></a>
            </div>
        </div>
    </div>
</section>

@include('frontend_zz.inc._financial-services')

@if(count($homePageLanding->cards) > 0)
@include('frontend_zz.inc.cards._stuff-cards-desktop', [ 'stuffCards' => $homePageLanding->cards ])
@include('frontend_zz.inc.cards._stuff-cards-mobile',  [ 'stuffCards' => $homePageLanding->cards ])
@endif

@endsection