@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Failz') . ' - ' . trans('users::global.ZugarZnap title'))

@section('meta_title', trans('users::global.Failz'))
@section('meta_description', 'Welcome to Zugar Znap &reg; StupidHappenz')

@if($fail)
@section('meta_image', $fail->obj_link)
@endif

@section('main')

    @if(count($pageFailz->headerBlock) > 0)
        @include('frontend_zz.inc._page_header_block', ['headerBlock'=>$pageFailz->headerBlock,'moveTo'=>'#failgifz'])
    @endif

    <section class="stupid-happenz">
        <div class="container container-1024">
            <a id="b21"></a>

            <div class="row" id="failgifz">
                @if(count($pageFailz->failzOptionsLeft) > 0)
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 main-images">
                        <div class="options-content">
                            <div class="red-gradient">
<<<<<<< HEAD
                                <div class="content content-left-fail" onclick="playOrStopFail('.content-left-fail');" style="background: #000 url('{{$left_option->obj_link_placeholder}}') no-repeat center center;" data-image="{{$left_option->obj_link_placeholder}}" data-playgif="{{$left_option->obj_link}}" data-url="{{ urlencode(route('failzView', ['id' => $left_option->id])) }}">
=======
                                <div class="content" style="background: url('{{$left_option->obj_link_placeholder}}') no-repeat center center;" data-image="{{$left_option->obj_link_placeholder}}" data-playgif="{{$left_option->obj_link}}" data-url="{{ urlencode(route('failzView', ['id' => $left_option->id])) }}">
>>>>>>> test
                                    @include('frontend_zz.inc._share')
                                    <div class="play-button"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(count($pageFailz->failzOptionsRight) > 0)
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 main-images">
                        <div class="options-content">
                            <div class="green-gradient">
<<<<<<< HEAD
                                <div class="content content-right-fail" onclick="playOrStopFail('.content-right-fail');" style="background: #000 url('{{$right_option->obj_link_placeholder}}') no-repeat center center;" data-image="{{$right_option->obj_link_placeholder}}" data-playgif="{{$right_option->obj_link}}" data-url="{{ urlencode(route('failzView', ['id' => $right_option->id])) }}">
=======
                                <div class="content" style="background: url('{{$right_option->obj_link_placeholder}}') no-repeat center center;" data-image="{{$right_option->obj_link_placeholder}}" data-playgif="{{$right_option->obj_link}}" data-url="{{ urlencode(route('failzView', ['id' => $right_option->id])) }}">
>>>>>>> test
                                    @include('frontend_zz.inc._share')
                                    <div class="play-button"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row images">
                @foreach($failz as $key=>$fail)
                    @if($key==3 || $key==8)
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 advertising">
                            <div class="img-type" style="background: url('{{ $fail->getImageUrl() }}') no-repeat center center;">
                                <div class="desc">
                                    <div class="title"><span>{{ $fail->title }}</span></div>
                                    <div class="description">
                                    {!! $fail->card_title !!}
                                    </div>
                                </div>
                                <a class="see-benefits {{ $fail->button_link == null ? 'disable' : '' }}" href="{{ $fail->button_link }}">{{ $fail->button_title }}</a>
                            </div>
                        </div>
                        @continue
                    @endif

                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<<<<<<< HEAD
                        <div class="content" onclick="playOrStopFail('.content-{{ $key }}');" style="background: #000 url('{{$fail->obj_link_placeholder}}') no-repeat center center;" data-image="{{$fail->obj_link_placeholder}}" data-playgif="{{$fail->obj_link}}" data-url="{{ urlencode(route('failzView', ['id' => $fail->id])) }}">
=======
                        <div class="content" style="background: #000 url('{{$fail->obj_link_placeholder}}') no-repeat center center;" data-image="{{$fail->obj_link_placeholder}}" data-playgif="{{$fail->obj_link}}" data-url="{{ urlencode(route('failzView', ['id' => $fail->id])) }}">
>>>>>>> test
                            @include('frontend_zz.inc._share')
                            <div class="play-button"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <button class="load-more">Load More</button>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 giphy-logo">
                    <img src="img/giphy-logo.png" class="img-responsive">
                </div>
            </div>
        </div>
    </section>

    @if(count($pageFailz->cards) > 0)
        @include('frontend_zz.inc.cards._stuff-cards-desktop', [ 'stuffCards' => $pageFailz->cards ])
        @include('frontend_zz.inc.cards._stuff-cards-mobile',  [ 'stuffCards' => $pageFailz->cards ])
    @endif

@section('js')
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('body').on('click','.content',function(){
                playOrStopFail(this);
            });


            $('body').on('click','.fb',function(){
                var local = $(this).closest('.content').data('url');
                var url = 'https://www.facebook.com/sharer/sharer.php?u='+local;
                window.open(url,'_blank');
            });

            $('body').on('click','.tw',function(){
                var local = $(this).closest('.content').data('url');
                var url = 'https://twitter.com/intent/tweet?url='+local+'&text=StupidHappenz';
                window.open(url,'_blank');
            });


            $('body').on('click','.fb',function(){
                var local = $(this).closest('.content').data('url');
                var url = 'https://www.facebook.com/sharer/sharer.php?u='+local;
                window.open(url,'_blank');
            });

            $('body').on('click','.tw',function(){
                var local = $(this).closest('.content').data('url');
                var url = 'https://twitter.com/intent/tweet?url='+local+'&text=StupidHappenz';
                window.open(url,'_blank');
            });

            // LOAD MORE

            var page = 2;
            var $failz_load_button = $('.load-more');
            var initial    = 'LOAD MORE',
                pleaseWait = 'PLEASE WAIT ...';
            $failz_load_button.click(function(){

                $.ajax({
                    url : '/failz/ajax/' + page,
                    method : 'get',
                    beforeSend : function() {
                        $failz_load_button.text(pleaseWait);
                        $failz_load_button.attr('disabled', 'disabled')
                    },
                    complete : function(){
                        $failz_load_button.text(initial);
                    }
                })
                .done(function(rsp) {
                    if(rsp != ""){
                        $('.images').append(rsp);
                        page++;
                    }
                    else {
                        $failz_load_button.hide();
                    }
                })
                .fail(function(rsp) {
                    //
                })
                .always(function() {
                    $failz_load_button.removeAttr('disabled');
                    $failz_load_button.text(initial);
                });
            });

            function playOrStopFail(failElement){
                $(failElement).find('.play-button').toggle();
                $(failElement).find('.share-block').toggle();

                if($(failElement).find('.play-button').is(':visible')) {
                    $(failElement).css('background-image','url(' + $(failElement).attr('data-image') + ')' );
                } else {
                    $(failElement).css('background-image','url(' + $(failElement).attr('data-playgif') + ')');
                }
            }
        });
    </script>
    @endsection
@endsection