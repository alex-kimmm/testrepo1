@extends('frontend.layouts.app')

@section('title', trans('users::global.#StupidHappenz') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')
@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')
<section class="cards-grid">
    <div class="row failz-list">
        @foreach($failz as $fail)
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" id="{{$fail->id}}">
                <div class="gif-container">
                    <a href="/failz-detail/{{$fail->id}}">
                        <div class="gif-card" style="background-image: url({{$fail->obj_link_placeholder}});"></div>
                    </a>
                    <div class="btn-play-gif">
                        <a href="/failz-detail/{{$fail->id}}">
                            <img src="/img/svg/play_GIF.png">
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="failz-load-more-section back-button text-center">
        <?php
            $page = (Request::segment(3)) ? Request::segment(3)+1 : '2';
        ?>
        <button class="btn btn-yellow failz-load-more" onclick="setLastElem();">Load More</button>
    </div>
</section>
@endsection

@section('js')
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var itemToScroll = window.localStorage.getItem('itemToScroll');
        if(itemToScroll) {
            var to = $('#'+itemToScroll).offset().top - $('.navbar-default.navbar-landing').outerHeight();
            goToScroll('html, body',to + 'px', 500);
            localStorage.removeItem('itemToScroll');
        }
    });

    function setLastElem() {
        var elemID = $('.failz-list > div:last').attr("id");
        location.href='/failz/page/<?php echo $page;?>#'+elemID;
    }
</script>
@endsection
