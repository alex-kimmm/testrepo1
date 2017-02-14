@extends('frontend.layouts.app')

@section('title', trans('users::global.Face of ZZ') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')

<section class="cards-grid">
    <div class="row cyan-gradient">
        <div class="content-page">
            <div class="container">
                {!! $content->body !!}
            </div>
        </div>
    </div>
</section>

@endsection
