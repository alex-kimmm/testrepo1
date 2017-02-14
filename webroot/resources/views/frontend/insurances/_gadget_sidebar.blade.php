<div class="box-wrapper loading hidden-xs">

    <div class="box">
        @if(count($sidebar_blocks) > 0)
            <div class="slideshow-sidebar">
                <div data-ride="carousel" class="carousel slide gadget-slider" id="carousel-example-generic">
                    <div role="listbox" class="carousel-inner">

                        @foreach($sidebar_blocks as $key=>$block)
                            <div class="item @if($key == 0) active @endif" style="height: 260px">
                                {!! $block->translations[0]->body !!}
                            </div>
                        @endforeach
                    </div>

                    @if(count($sidebar_blocks) > 1)
                    <div class="carousel-controls">
                        <a data-slide="prev" role="button" href="#carousel-example-generic" class="left carousel-control hidden-xs">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <ol class="carousel-indicators">
                            @foreach($sidebar_blocks as $key=>$block)
                                <li class="@if($key == 0) active @endif" data-slide-to="{{$key}}" data-target="#carousel-example-generic"></li>
                            @endforeach
                        </ol>
                        <a data-slide="next" role="button" href="#carousel-example-generic" class="right carousel-control hidden-xs">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        @endif
        <img  src="/img/sidebar-close.png" class="sidebar-close" onclick="sidebar.toggle()">

    </div>

</div>