<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 visible-xs">

    <div class="box-mobile-wrap">
        @if(count($sidebar_blocks) > 0)
        <div class="box-mobile">
            <div class="slideshow-sidebar">

                <div id="myCarousel" class="carousel slide gadget-slider" data-ride="carousel">
                    @if(count($sidebar_blocks) > 1)
                        <ol class="carousel-indicators">
                            @foreach($sidebar_blocks as $key=>$block)
                                <li data-target="#myCarousel" data-slide-to="{{$key}}" class="@if($key == 0) active @endif"></li>
                            @endforeach
                        </ol>
                        <div class="control-arrow">
                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @endif
                    <div class="carousel-inner" role="listbox">
                        @foreach($sidebar_blocks as $key=>$block)
                            <div class="item @if($key == 0) active @endif" style="height: 260px">
                                {!! $block->translations[0]->body !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>