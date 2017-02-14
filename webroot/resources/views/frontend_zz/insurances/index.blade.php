@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Insurance') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend_zz.inc._page_header_block', [ 'headerBlock' => $insuranceLanding->headerBlock ])

<section class="all-benefits insurance-all-benefits">
    <a id="b21"></a>
    <div class="container container-1024">
        <div class="row benefits-content padding-bottom-10px">

            @forelse($insuranceLanding->homePageBlocks as $homePageBlock)
                @include('frontend_zz.inc.blocks._header-second-block', [ 'secondHeaderBlock' => $homePageBlock])
            @empty
            @endforelse

            @if(count($insuranceLanding->coverCardBlocks) > 0)
            <div id="b3" class="nav-points anim-anchor">
<<<<<<< HEAD
                <span>Cover my...</span>
=======
                <span>Cover my</span>
>>>>>>> test
            </div>

            <div class="row cover-me">
                @foreach($insuranceLanding->coverCardBlocks as $index => $coverCard)
                @include('frontend_zz.inc.cards._cover-card', [ 'position' => (($index > 0 && $index % 2 != 0) ? 'right' : 'left'), 'coverCard' => $coverCard ])
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>

@include('frontend_zz.inc._financial-services')

@if(count($insuranceLanding->cards) > 0)
@include('frontend_zz.inc.cards._stuff-cards-desktop', [ 'stuffCards' => $insuranceLanding->cards ])
@include('frontend_zz.inc.cards._stuff-cards-mobile',  [ 'stuffCards' => $insuranceLanding->cards ])
@endif

@endsection