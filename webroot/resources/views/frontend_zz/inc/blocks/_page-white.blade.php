<div class="white-div">
    <div class="col-md-6 col-sm-6">
        <div class="white-div-content">
            <div class="top-label first">
                <span class="general homepage">{{ $block->title }}</span>
            </div>
            <div class="simple-text hidden-xs">
                {!! $block->body !!}
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="benefits-img" style="background-image: url('{{$block->getImageUrl()}}');"></div>
    </div>
</div>
<a target="_blank" href="https://www.facebook.com/zugarznap/" class="btn btn-cover-me">Click here to enter now</a>