@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Music') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend_zz.inc._page_header_block', ['headerBlock'=>$musicLandingPage->headerBlock])

<section class="all-benefits insurance-all-benefits music">
    <a id="b21"></a>
    <div class="container container-1024">
        <div class="row benefits-content">

            @forelse($musicLandingPage->homePageBlocks as $homePageBlock)
                @include('frontend_zz.inc.blocks._header-second-block', [
                'secondHeaderBlock' => $homePageBlock,
                'showWaterBlock' => true,
                ])
            @empty
            @endforelse

            <div class="nav-points" id="b3">
                <span>Featured artist</span>
            </div>


            @if($mainArtist)
                @include('frontend_zz.music.main_artist',['musicCard'=>$mainArtist])
            @endif

            <div class="row cover-me">
                <?php $indexOfRow = 0;?>
                @if($musicCards->count()>1)
                    @foreach($musicCards as $key => $musicCard)
                        @if($key > 0)
                            @include('frontend_zz.music.artist_card',[
                            'musicCard' => $musicCard,
                            'position' => (($indexOfRow % 2 == 0) ? 'left' : 'right'),
                            ])
                            <?php $indexOfRow++;?>
                        @endif
                    @endforeach
                @endif

                @forelse($musicLandingPage->cardCoverBlocks as $index => $coverCard)
                    @include('frontend_zz.inc.cards._cover-card', [ 'position' => (($indexOfRow % 2 == 0) ? 'left' : 'right'), 'coverCard' => $coverCard ])
                    <?php $indexOfRow++;?>
                @empty
                @endforelse

            </div>

        </div>
    </div>
</section>

@include('frontend_zz.inc._financial-services')

@if(count($musicLandingPage->cards) > 0)
@include('frontend_zz.inc.cards._stuff-cards-desktop', [ 'stuffCards' => $musicLandingPage->cards ])
@include('frontend_zz.inc.cards._stuff-cards-mobile',  [ 'stuffCards' => $musicLandingPage->cards ])
@endif

@endsection

@section('js')

<script type="text/javascript">
//<![CDATA[

$(document).ready(function(){

	/*
	 * Instance CirclePlayer inside jQuery doc ready
	 *
	 * CirclePlayer(jPlayerSelector, media, options)
	 *   jPlayerSelector: String - The css selector of the jPlayer div.
	 *   media: Object - The media object used in jPlayer("setMedia",media).
	 *   options: Object - The jPlayer options.
	 *
	 * Multiple instances must set the cssSelectorAncestor in the jPlayer options. Defaults to "#cp_container_1" in CirclePlayer.
	 *
	 * The CirclePlayer uses the default supplied:"m4a, oga" if not given, which is different from the jPlayer default of supplied:"mp3"
	 * Note that the {wmode:"window"} option is set to ensure playback in Firefox 3.6 with the Flash solution.
	 * However, the OGA format would be used in this case with the HTML solution.
	 */

    // Example from https://github.com/maboa/circleplayer/blob/master/index.htm
    $('.cp-jplayer').each(function(i, obj) {
        var dataSongSrc = $(this).data('src');
        var cpContainer = '#' + $(this).data('cpcontainer');
        var musicId = '#'+ $(this).attr('id');

        var myCirclePlayer = new CirclePlayer( musicId ,
        	{
        		mp3: dataSongSrc
        	}, {
        	    supplied: "m4a, oga, mp3",
        		cssSelectorAncestor: cpContainer,
        		swfPath: "../../dist/jplayer",
        		wmode: "window",
        		keyEnabled: true
        	});
    });

});
//]]>
</script>

@endsection