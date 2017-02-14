<div class="col-md-4 col-sm-4 great-stuff-card" onclick="javascript:location.href='{{$stuffCard->redirect_link}}'" style="cursor:pointer;">
    <div class="gradient-card" style="{{ $stuffCard->gradient->summary }}">
        <div class="great-stuff-white-bg">
            <div class="great-stuff-img">
                <img src="{{ $stuffCard->getImageUrl()  }}" class="img-responsive">
            </div>
            <div class="great-stuff-desc">
                <span class="label label-great-stuff" style="background-color: #{{ $stuffCard->title_background_color }};">{{ $stuffCard->title }}</span>
                <p class="dont-break-out">{{ $stuffCard->summary }}</p>
            </div>
        </div>

    </div>
</div>