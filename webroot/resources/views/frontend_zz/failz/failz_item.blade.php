@if(count($failz) > 0)
    @foreach($failz as $key => $fail)
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="content" onclick="playOrStopFail('.content-{{ $key }}');" style="background: #000 url('{{$fail->obj_link_placeholder}}') no-repeat center center;" data-image="{{$fail->obj_link_placeholder}}" data-playgif="{{$fail->obj_link}}" data-url="{{ urlencode(route('failzView', ['id' => $fail->id])) }}">
                @include('frontend_zz.inc._share')
                <div class="play-button"></div>
            </div>
        </div>
    @endforeach
@endif
