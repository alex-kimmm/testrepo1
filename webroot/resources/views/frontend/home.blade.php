@extends('frontend.layouts.app')

@section('title', trans('users::global.ZugarZnap'))

@section('main')

@include('frontend.inc._quote', ['quote'=>$quote])
@include('frontend.inc._nav-mobile-extern')
<div class="zz-logo object-z-index-500">
    <a href="/"><img src="img/logo.png"></a>
</div>
<div class="row slideshow-container">
    @if(count($slides) > 0)
        <video autoplay poster="{{reset($images)}}" id="bgvid" loop>
            <source src="{{reset($videos)}}" type="video/mp4">
        </video>
        <div class="slideshow slideshow-900">
        <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
            <div style="margin:auto;width:100%;">
                <div data-ride="carousel" class="carousel slide" id="carousel-example-generic">
                    <div role="listbox" class="carousel-inner">
                        @foreach($slides as $key=>$item)
                            @if($item->product)
                                <div class="item @if($key == 0) active @endif">
                                    <div class="deco-paragraph-container-mobile visible-xs">
                                        {!! $item->body !!}
                                    </div>
                                    <div class="card card-slideshow" onclick="javascript:location.href='{{$item->product->getSeoUrl()}}'" style="cursor:pointer;@if($item->product->image) background-image: url({{$item->product->getImageUrl()}});@endif">
                                        <div class="deco-paragraph-container hidden-xs">
                                            {!! $item->body !!}
                                        </div>

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
                                    <div class="text-deco-right">
                                        <div class="text-deco-right-contents" style="text-align: left">{!! $item->summary !!}</div>
                                    </div>
                                </div>
                            @else
                                <div class="item @if($key == 0) active @endif">
                                    <div class="deco-paragraph-container-mobile visible-xs">
                                        {!! $item->body !!}
                                    </div>
                                    <div class=" card card-text-slider">
                                        <div class="deco-paragraph-container hidden-xs">
                                            {!! $item->body !!}
                                        </div>

                                        <div class="card-text-content">
                                            <h3>{{$item->page->title}}</h3>
                                            <div class="card-text-p">
                                                {!! $item->page->body !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-deco-right">
                                        <div class="text-deco-right-contents" style="text-align: left">{!! $item->summary !!}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @if(count($slides) > 1)
                        <ol class="carousel-indicators">
                            @foreach($slides as $key=>$item)
                                <li class="@if($key == 0) active @endif" data-slide-to="{{$key}}" data-target="#carousel-example-generic"></li>
                            @endforeach
                        </ol>
                        <a data-slide="prev" role="button" href="#carousel-example-generic" class="left carousel-control"> <span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span> <span class="sr-only">Previous</span> </a>
                        <a data-slide="next" role="button" href="#carousel-example-generic" class="right carousel-control"> <span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span> <span class="sr-only">Next</span> </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@include('frontend.inc._nav')
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

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.carousel').bind('slide.bs.carousel', function (e) {

                var videos = {!! json_encode($videos) !!};
                var images = {!! json_encode($images) !!};

                var slideTo = $(e.relatedTarget).index();
                console.log(slideTo);
                $('#bgvid').attr('poster',images[slideTo]);
                $('#bgvid > source').attr('src',videos[slideTo]);
                $("#bgvid")[0].load();
            });
        });
    </script>
@endsection