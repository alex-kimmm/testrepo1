@extends('frontend.layouts.app')

@section('title', $category->title . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')

@if(count($category->products) > 0)
<section class="cards-grid">
    <div class="row">
    <div class="clothing-{{ $category->slug }}">
            <ol class="breadcrumb zz-breadcrumb">
                <li><a href="{{ROOT_URL_CLOTHING}}">Clothing</a></li>
                <li class="active"class="active"><a href="{{ $category->getSeoUrl() }}">{{ $category->title }}</a></li>
            </ol>
            <div class="top-white-logo hidden-xs">
                <img src="{{URL::asset('img/logo-white.png')}}">
            </div>
            <div class="row">
                <div class="container">
                    <div class="boy-clothing-page">
                        <div class="row">
                            @if(count($slider) > 0)
                            <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs shirts-hoodies-container">
                                {{--<div class="shirts-hoodies">--}}
                                    {{--<div class="t-shirts"><a href="">T-shirts</a></div>--}}
                                    {{--<div class="hoodies"><a href="">Hoodies</a></div>--}}
                                {{--</div>--}}
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="text-deco {{ $category->slug }} hidden-xs">
                                    <div class="text-deco-contents">{{ $category->title }}</div>
                                </div>
                                <div class="text-deco {{ $category->slug }}-text2 hidden-xs">
                                    <div class="text-deco-contents">
                                        with a<br>
                                        whole lot<br>
                                        of extra<br>
                                        awesome!!
                                    </div>
                                </div>
                                <div style="margin:auto;width:100%;">
                                    <div data-ride="carousel" class="carousel slide" id="carousel-example-generic">
                                        @if(count($slider) > 1)
                                            <ol class="carousel-indicators">
                                                @foreach($slider as $key=>$item)
                                                    <li data-slide-to="{{$key}}" data-target="#carousel-example-generic" class="@if($key == 0) active @endif"></li>
                                                @endforeach
                                            </ol>
                                        @endif
                                        <div role="listbox" class="carousel-inner">
                                            @foreach($slider as $key=>$item)
                                                @if($item->product)
                                                    <div class="item @if($key == 0) active @endif">
                                                        <div class="card" onclick="javascript:location.href='{{$item->product->getSeoUrl()}}'" style="cursor: pointer;@if($item->product->image)background-image: url({{$item->product->getImageUrl()}});@endif">
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
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                            </div>
                            <div class="">
                                <a href="{{ROOT_URL_CLOTHING}}" class="view-all">view all</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        @foreach($category->products as $i => $product)
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                @include('frontend.inc._card', ['theme' => $themes[$i % count($themes)], 'product' => $product, 'cardTheme' => 'light'])
            </div>
        @endforeach
        @include('frontend.inc._missed',['missed'=>$missed,'themes'=>$themes,'class'=>'col-lg-4 col-md-4 col-sm-4 hidden-xs','range'=>'3'])
        @include('frontend.inc._missed',['missed'=>$mobileMissed,'themes'=>$themes,'class'=>'col-xs-6 visible-xs','range'=>'2'])
        </div>
    </div>
</section>
@else
<div>Does not exist category <b>{{ $category->title }}</b> with products</div>
@endif

@endsection