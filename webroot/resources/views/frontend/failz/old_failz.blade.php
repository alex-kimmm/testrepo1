@extends('frontend.layouts.app')

@section('title', $fail->title . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>


@if( count($failz) != 0 )

<div class="failz-list">
@foreach($failz as $fail)

    @if( trim($fail->obj_link) != "")
    <div>
        <img src="{{ $fail->obj_link }}" width="100">
    </div>
    @endif

	<span class='st_facebook' st_url="{{ $fail->getUrl() }}" st_title="{{ $fail->title }}"></span>
    <span class='st_twitter' st_url="{{ $fail->getUrl() }}" st_title="{{ $fail->title }}"></span>

    {{ $fail->title }}.
    Likes: <span class="count_{{ $fail->id }}">{{ count($fail->likes) }}</span>.
    Tags: {{ count($fail->tags) }}
    @if(count($fail->tags) > 0) :
        @foreach($fail->tags as $tag)
            {{ $tag->name }},
        @endforeach
    @endif

    @if($fail->likeable)
    <button class="failz-like-button" data-fail-id="{{ $fail->id }}">Like</button>
    @else
    <button class="failz-like-button" data-fail-id="{{ $fail->id }}">Dislike</button>
    @endif

    <hr>

@endforeach
</div>

<button class="failz-load-more">Load more</button>

@else
    <p>There are not failz</p>
@endif


<script type="text/javascript">
    jQuery(document).ready(function($) {

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


        // LOAD MORE

        var page = 2;
        var $failz_load_button = $('.failz-load-more');
        $failz_load_button.click(function(){

            $.ajax({
                url : '/failz/ajax/' + page,
                method : 'get',
                beforeSend : function() {
                    $failz_load_button.attr('disabled', 'disabled')
                }
            })
            .done(function(rsp) {
                if(rsp != ""){
                    $('.failz-list').append(rsp);
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
                $failz_load_button.removeAttr('disabled')
            });
        });
    });
</script>

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "0d14c340-5d98-45bd-a132-fdcde6e3e0ac", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
@endsection
