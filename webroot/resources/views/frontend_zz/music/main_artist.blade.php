<div class="row musician main-artist">
    <h1>{{$musicCard->title}}</h1>
    <div class="col-md-6 col-sm-6 pull-right">
        <div class="musician-img">
            <img src="{{$musicCard->getImageUrl()}}" class="img-responsive img-circle">
            @include('frontend_zz.music.music_button',[
                'musicCard' => $musicCard
            ])
            {{--<button class="btn btn-music-play"></button>--}}
        </div>
    </div>
    <div class="col-md-6 col-sm-6 pull-left">
        <div class="musician-desc">
            <h4>{{$musicCard->summary}}</h4>
            {!!$musicCard->body!!}
        </div>
    </div>
</div>