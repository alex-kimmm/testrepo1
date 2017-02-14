@if(count($failz) > 0)
    @foreach($failz as $fail)
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            <div class="gif-container">
                <a href="/failz-detail/{{$fail->id}}">
                    <div class="gif-card" style="background-image: url({{$fail->obj_link_placeholder}});"></div>
                </a>
                <div class="btn-play-gif">
                    <a href="/failz-detail/{{$fail->id}}">
                        <img src="img/svg/play_GIF.png">
                    </a>
                </div>
            </div>
        </div>
    @endforeach
@endif
