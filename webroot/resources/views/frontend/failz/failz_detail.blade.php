@extends('frontend.layouts.app')

@section('title', $fail->title . ' - ' . trans('users::global.ZugarZnap title'))

@section('meta_title', $fail->title)
@section('meta_description', 'Welcome to Zugar Znap &reg; StupidHappenz')
@section('meta_image', $fail->obj_link_placeholder)

@section('main')
@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')
<section class="cards-grid">
    <div class="row">
        <div class="failz-detail">
            <div class="container">
                <div class="gif-view row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="gif-view-container">
                            <a href="javascript:void(0);" class="gif-view-card-block">
                            <div class="gif-view-card" style="background-image: url('{{$fail->obj_link_placeholder}}'); "></div>
                            <div class="gif-view-card hide-item" style="background-image: url('{{$fail->obj_link}}'); "></div>
                            </a>
                            <div class="btn-play-gif text-center play-gif-action">
                                <img src="{{asset('img/svg/play_GIF.png')}}">
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 gif-desc">
                        <a href="javascript:void(0);" id="redirectToFailz" data-item="{{$fail->id}}"><div class="close-info hidden-xs"></div></a>
                        <h2>{{$fail->title}}</h2>
                        <h3>{{$fail->summary}}</h3>
                        <div class="gif-tags">
                            @foreach($fail->tags as $tag)
                                <span class="label label-gry">#{{$tag->name}}</span>
                            @endforeach
                        </div>
                        <div class="row gif-share">
                            <div class="col-md-6 col-md-6 col-sm-6 col-xs-6 gif-option">

                                {{--<div class="btn-group" role="group">--}}
                                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-option-horizontal"></i></a>--}}

                                    {{--<ul class="dropdown-menu">--}}
                                        {{--<div class="dropdown-arrow"></div>--}}
                                        {{--<li><a href="#">share url</a></li>--}}
                                        {{--<li><a href="#">Tumblr</a></li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="gif-social-icons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(URL::current()) }}" target="_blank"><div class="white-fb"></div></a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(URL::current()) }}&text=StupidHappenz" target="_blank"><div class="white-tw"></div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($products as $i => $product)
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                @include('frontend.inc._card', ['theme' => $themes[$i % count($themes)], 'product' => $product, 'cardTheme' => 'light'])
            </div>
        @endforeach
        @include('frontend.inc._missed',['missed'=>$mobileMissed,'themes'=>$themes,'class'=>'col-xs-6 visible-xs','range'=>'2'])
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#redirectToFailz').click(function(){
            var itemToScroll = $(this).data('item');
            window.localStorage.setItem('itemToScroll', itemToScroll);
            window.history.back();
        });

        // LIKE
        var $failz_like_button = $('.failz-like-button');
        $( ".failz-list" ).on( "click", ".failz-like-button",function(){
            var $this = $(this);
            var id = $this.data('fail-id');

            $.ajax({
                url : '/failz/like',
                method : 'post',
                data : {id : id},
                beforeSend : function() {
                    $failz_like_button.attr('disabled', 'disabled')
                }
            })
            .done(function(rsp) {
                if(typeof rsp.to_display != 'undefined'){
                    $this.text(rsp.to_display);
                    $('.count_' + id).text(rsp.count);
                }
                else alert(rsp.message);
            })
            .fail(function(rsp) {
                alert(rsp.message);
            })
            .always(function() {
                $failz_like_button.removeAttr('disabled')
            });
        });

        $('.play-gif-action, .gif-view-card-block').click(function(){
            $('.play-gif-action, .gif-view-card-block .gif-view-card').toggleClass('hide-item');
        });
    });
</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "0d14c340-5d98-45bd-a132-fdcde6e3e0ac", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
@endsection

@section('css')
<style>
    .hide-item {
        display: none;
    }
</style>
@endsection