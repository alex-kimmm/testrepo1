<style>

    @if($headerBlock->getImageUrl())
        .header.header-1024{
            background-image: url('{{$headerBlock->getImageUrl()}}')
        }
    @endif
    @if($headerBlock->getImageMobileUrl())
        @media (max-width: 767px){
            .header.header-1024{
                background-image: url('{{$headerBlock->getImageMobileUrl()}}')
            }
        }
    @endif

</style>
<section class="insurance-landing homepage-landing music-header cd-intro">
    <div class="container container-1024">
        <div class="row">
            <div id="headerBlock" class="header header-1024">
                <div class="top-label">
                    <span @if($headerBlock->gradient) style="{{ $headerBlock->gradient->summary }}" @endif class="general blue-label">{{$headerBlock->quote_text}}</span>
                </div>
                <div class="top-label top-label-large">
                    <span @if($headerBlock->gradient) style="{{ $headerBlock->gradient->summary }}" @endif class="general blue-label">{{$headerBlock->quote_subtext}}</span>
                </div>


                @if($headerBlock->getVideoUrl())
                    <div class="videoHeaderContainerOuter @if($headerBlock->auto_play) playing @else paused @endif " id="videoHeaderContainerOuter">
                        <div id="videoHeaderPlayButton" class="play-button"></div>
                        <div id="videoHeaderContainer" class="videoHeaderContainer">
                            <video @if($headerBlock->auto_play) autoplay="autoplay" @endif id="videoHeader" loop="loop" class="hidden-xs header-video">
                                <source src="{{$headerBlock->getVideoUrl()}}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                @endif

                <div class="benefits-arrow-bottom">
                    <a href="#b21" class="anim-anchor"><img src="img/benefits-arrow-bottom.png"></a>
                </div>

            </div>
        </div>
    </div>
</section>