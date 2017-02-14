@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Insurance') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<div class="faceofzz">
    @if(count($faceofzzLandingPage->headerBlock) > 0)
        @include('frontend_zz.inc._page_header_block', ['headerBlock'=>$faceofzzLandingPage->headerBlock])
    @endif

    @if(count($faceofzzLandingPage->homePageBlocks) > 0)
        <section class="all-benefits insurance-all-benefits music face-of-zz">
            <a id="b21"></a>
            <div class="container container-1024">
                <div class="row benefits-content">
                    <div class="nav-points">
                        <span>{{$faceofzzLandingPage->summary}}</span>
                    </div>
                    @if(isset($faceofzzLandingPage->homePageBlocks[0]))
                        @include('frontend_zz.inc.blocks._musician', ['musician'=>$faceofzzLandingPage->homePageBlocks[0]])
                    @endif
                    @if(isset($faceofzzLandingPage->homePageBlocks[1]))
                        @include('frontend_zz.inc.blocks._page-white', ['block'=>$faceofzzLandingPage->homePageBlocks[1]])
                    @endif
                </div>
            </div>
        </section>
    @endif

    @include('frontend_zz.inc._financial-services')

    @if(count($faceofzzLandingPage->cards) > 0)
        @include('frontend_zz.inc.cards._stuff-cards-desktop', [ 'stuffCards' => $faceofzzLandingPage->cards ])
        @include('frontend_zz.inc.cards._stuff-cards-mobile',  [ 'stuffCards' => $faceofzzLandingPage->cards ])
    @endif

</div>

@endsection