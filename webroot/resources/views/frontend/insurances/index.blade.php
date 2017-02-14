@extends('frontend.layouts.app')

@section('title', trans('users::global.Insurance') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._quote', ['quote'=>$quote])
@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')

@if(count($slideshow) > 0)
<div class="row slideshow-insurance-container">
    <div class="slideshow">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div style="margin:auto;width:100%;">
                <div data-ride="carousel" class="carousel slide" id="carousel-example-generic">
                    <div role="listbox" class="carousel-inner">
                        @foreach($slideshow as $key=>$item)
                        @if($item->product)
                        <div class="item @if($key == 0) active @endif">
                            <div class="container">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <h1 class="insurance-title">Insurance</h1>
                                    @if($dataInsurances['gadgetCover'])
                                    <a href="{{ $dataInsurances['gadgetCover']->getSeoUrl() }}">
                                        <h1 class="insurance-slide-badge">
                                            <span>Gadget cover</span>
                                        </h1>
                                    </a>
                                    @endif

                                    @if($dataInsurances['xsCover'])
                                    <a href="{{ $dataInsurances['xsCover']->getSeoUrl() }}">
                                        <h1 class="insurance-slide-badge">
                                            <span>Excess cover</span>
                                        </h1>
                                    </a>
                                    @endif
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="card" onclick="javascript:location.href='{{$item->product->getSeoUrl()}}'" style="cursor: pointer;@if($item->product->image) background-image: url({{$item->product->getImageUrl()}});@endif">
                                        <h1 class="card-badge">
                                            <span>{{$item->product->category->title}}</span>
                                        </h1>

                                        <div class="card-info card-info-light">
                                            <div class="open-bg open-bg-light">
                                                <a href="{{$item->product->getSeoUrl()}}" class="light-open btn-open">Open</a>
                                            </div>

                                            <div class="card-details">
                                                @if($item->product->price > 0)
                                                    <p class="card-price card-price-light">£{{formatPrice($item->product->price)}}</p>
                                                @endif
                                                <p class="card-title card-title-light">{{$item->product->title}}</p>
                                                <p class="card-description card-description-light">{{$item->product->summary}}</p>
                                                <div class="card-like"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 insurance-desc">
                                    <h1 class="insurance-slider-title">{{$item->title}}</h1>
                                    <div class="insurance-desc-content">
                                        {!! $item->summary !!}
                                        <h3 class="insurance-subtitle">{{$item->subtitle}}</h3>
                                        {!! $item->body !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @if(count($slideshow) > 1)
                        <ol class="carousel-indicators">
                            @foreach($slideshow as $key=>$item)
                                <li class="@if($key == 0) active @endif" data-slide-to="{{$key}}" data-target="#carousel-example-generic"></li>
                            @endforeach
                        </ol>
                        <a data-slide="prev" role="button" href="#carousel-example-generic" class="left carousel-control hidden-xs">
                            <span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a data-slide="next" role="button" href="#carousel-example-generic" class="right carousel-control hidden-xs">
                            <span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="detail-white-line visible-xs">
    <p>You might also like these.</p>
</div>

@if(count($products) > 0)
<section class="cards-grid">
    <div class="row">
        @foreach($products as $i => $product)
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                @include('frontend.inc._card', ['theme' => $themes[$i % count($themes)], 'product' => $product, 'cardTheme' => 'light'])
            </div>
        @endforeach
        @include('frontend.inc._missed',['missed'=>$missed,'themes'=>$themes,'class'=>'col-lg-4 col-md-4 col-sm-4 hidden-xs','range'=>'3'])
        @include('frontend.inc._missed',['missed'=>$mobileMissed,'themes'=>$themes,'class'=>'col-xs-6 visible-xs','range'=>'2'])
    </div>
</section>
@endif

@endsection