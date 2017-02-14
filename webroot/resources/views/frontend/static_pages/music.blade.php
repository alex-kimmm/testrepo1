@extends('frontend.layouts.app')

@section('title', trans('users::global.Music') . ' - ' . trans('users::global.ZugarZnap title'))

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

<iframe width="100%" height="650" scrolling="no" frameborder="no" src="{{ asset('views/music/music.html') }}"></iframe>

@endsection