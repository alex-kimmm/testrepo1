@extends('frontend.layouts.app')

@section('title', $product->title . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')

<section class="row">
	<div class="clothing-detail">
        <ol class="breadcrumb zz-breadcrumb">
            <li><a href="{{ROOT_URL_CLOTHING}}">Clothing</a></li>
            <li><a href="{{ $product->category->getSeoUrl() }}">{{ $product->category->title }}</a></li>
            <li><a href="#">{{ $product->title }}</a></li>
        </ol>

        <div class="container">
            @include('frontend.inc._card_details', ['product' => $product])
        </div>
    </div>

    <div class="detail-red-line">
        <p>You might also like these.</p>
    </div>
</section>


<section class="cards-grid">
    <div class="row">
    @foreach($lastProductsByCurrentCategory as $i => $lastProductByCurrentCategory)
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            @include('frontend.inc._card', ['theme' => $themes[ $i % count($themes)], 'product' => $lastProductByCurrentCategory, 'cardTheme' => 'dark'])
        </div>
    @endforeach
    @include('frontend.inc._missed',['missed'=>$missed,'themes'=>$themes,'class'=>'col-lg-4 col-md-4 col-sm-4 hidden-xs','range'=>'3'])
    @include('frontend.inc._missed',['missed'=>$mobileMissed,'themes'=>$themes,'class'=>'col-xs-6 visible-xs','range'=>'2'])
    </div>
</section>

@endsection