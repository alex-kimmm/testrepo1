@extends('frontend.layouts.app')

@section('title', trans('users::global.Clothing') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._quote', ['quote'=>$quote])
@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')

@if(count($products) > 0)
<section class="cards-grid">
    <div class="cat-clothing row">
        <div class="top-white-logo hidden-xs">
            <a href="/"><img src="{{URL::asset('img/logo-white.png')}}"></a>
        </div>
        @if(count($boyzslider) > 0)
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="boy-clothing">
                <div class="row">
                    <div class="text-deco hidden-xs">
                        <div class="text-deco-contents">
                        star wars<br>dc and all<br>the others</div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                        <div class="row view-boyz">
                            <a href="{{ROOT_URL_CLOTHING}}/boyz">
                                <div class="view">view</div>
                                <div class="boyz">boyz</div>
                            </a>
                        </div>

                        <div class="cloth-cat-container">
                            <h1 class="cloth-cat">
                                <span>t-shirts &hoodies</span>
                            </h1>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                        <div style="margin:auto;width:100%;">
                            <div data-ride="carousel" class="carousel slide" id="carousel-example-generic">
                                @if(count($boyzslider) > 1)
                                    <ol class="carousel-indicators">
                                        @foreach($boyzslider as $key=>$item)
                                            <li data-slide-to="{{$key}}" data-target="#carousel-example-generic" class="@if($key == 0) active @endif"></li>
                                        @endforeach
                                    </ol>
                                @endif
                                <div role="listbox" class="carousel-inner">
                                    @foreach($boyzslider as $key=>$item)
                                        @if($item->product)
                                            <div class="item @if($key == 0) active @endif">
                                                <div class="card" onclick="javascript:location.href='{{$item->product->getSeoUrl()}}'" style="cursor: pointer; @if($item->product->image) background-image: url({{$item->product->getImageUrl()}});@endif">
                                                    <div class="card-info card-info-dark">
                                                        <div class="open-bg open-bg-dark">
                                                            <a href="{{$item->product->getSeoUrl()}}" class="dark-open btn-open">Open</a>
                                                        </div>
                                                        <div class="card-details">
                                                            @if($item->product->price > 0)
                                                                <p class="card-price card-price-dark">£{{formatPrice($item->product->price)}}</p>
                                                            @endif
                                                            <p class="card-title card-title-dark">{{$item->product->title}}</p>
                                                            <p class="card-description card-description-dark">{{$item->product->summary}}</p>
                                                            <div class="card-like"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(count($girlzslider) > 0)
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="girl-clothing">
                <div class="row">
                    <div class="text-deco hidden-xs">
                        <div class="text-deco-contents">
                         all the<br>good stuff! </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 pull-right">
                        <div class="row view-girlz">
                            <a href="{{ROOT_URL_CLOTHING}}/girlz">
                                <div class="view">view</div>
                                <div class="girlz">girlz</div>
                            </a>
                        </div>

                        <div class="cloth-cat-container">
                            <h1 class="cloth-cat">
                                <span>t-shirts &hoodies</span>
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                        <div style="margin:auto;width:100%;">
                            <div data-ride="carousel" class="carousel slide" id="carousel-example-generic2">
                                @if(count($girlzslider) > 1)
                                    <ol class="carousel-indicators">
                                        @foreach($girlzslider as $key=>$item)
                                            <li data-slide-to="{{$key}}" data-target="#carousel-example-generic2" class="@if($key == 0) active @endif"></li>
                                        @endforeach
                                    </ol>
                                @endif
                                <div role="listbox" class="carousel-inner">
                                    @foreach($girlzslider as $key=>$item)
                                        @if($item->product)
                                            <div class="item @if($key == 0) active @endif">
                                                <div class="card" onclick="javascript:location.href='{{$item->product->getSeoUrl()}}'" style="cursor: pointer; @if($item->product->image) background-image: url({{$item->product->getImageUrl()}});@endif">
                                                    <div class="card-info card-info-dark">
                                                        <div class="open-bg open-bg-dark">
                                                            <a href="{{$item->product->getSeoUrl()}}" class="dark-open btn-open">Open</a>
                                                        </div>
                                                        <div class="card-details">
                                                            @if($item->product->price > 0)
                                                                <p class="card-price card-price-dark">£{{formatPrice($item->product->price)}}</p>
                                                            @endif
                                                            <p class="card-title card-title-dark">{{$item->product->title}}</p>
                                                            <p class="card-description card-description-dark">{{$item->product->summary}}</p>
                                                            <div class="card-like"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="detail-white-line visible-xs">
        <p>You might also like these.</p>
    </div>
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
@else
<div>Does not exist clothes</div>
@endif

@endsection