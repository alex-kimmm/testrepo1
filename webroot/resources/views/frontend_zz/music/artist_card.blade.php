<div class="col-md-6 col-sm-6 cover-me-card music-list-card cover-me-card-{{$position}}">
    <div class="music-musician-bg" style="background-image: url('{{$musicCard->getImageUrl()}}');">
        <div class="desc">
            <div class="title"><span>{{$musicCard->title}}</span></div>
            <div class="description"><div><span>{{$musicCard->summary}}</span></div></div>
        </div>
    </div>
    <div class="row play-music-block">
<<<<<<< HEAD
        <div class="col-md-2 col-sm-3 col-xs-3">
=======
        <div class="col-md-2 col-sm-2 col-xs-3">
>>>>>>> test
        @include('frontend_zz.music.music_button',[
            'musicCard' => $musicCard
        ])
        </div>
<<<<<<< HEAD
        <div class="col-md-10 col-sm-9 col-xs-9">
=======
        <div class="col-md-10 col-sm-10 col-xs-9">
>>>>>>> test
            <p>PLAY THE SAMPLE</p>
            <h3>{{$musicCard->song_name}}</h3>
        </div>
    </div>
</div>
