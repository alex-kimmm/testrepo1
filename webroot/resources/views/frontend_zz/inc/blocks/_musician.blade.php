<div class="row musician">
    <h1>{{$musician->title}}</h1>
    <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
        <div class="musician-img">
            <img src="{{$musician->getImageUrl()}}" class="img-responsive img-circle">
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
        <div class="musician-desc">
            <h4>{{$musician->summary}}</h4>
            {!!$musician->body!!}
        </div>
    </div>
</div>