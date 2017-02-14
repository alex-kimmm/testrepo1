<section class="all-benefits">
    <a id="{{ isset($anchor) ? $anchor : "" }}"></a>
    <div class="container container-1024">
        <div class="row benefits-content" style="background-image: url('{{ $homePageBlock->getBlockBackgroundImageUrl() }}')">
            <div class="white-div width-100">
                <div class="col-md-5 col-sm-6">
                    <div class="white-div-content">
                        <div class="top-label first">
                            <span class="general homepage">{{$homePageBlock->title}}</span>
                        </div>
                        <div class="top-label">
                            <span class="general homepage">{{$homePageBlock->subtitle}}</span>
                        </div>
                        <a class="btn btn-all-benefits hidden-xs" href="{{$homePageBlock->benefits_url}}" style="text-decoration: none">All the benefits</a>
                    </div>
                </div>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <div class="benefits-img" style="background-image: url('{{ $homePageBlock->getImageUrl() }}')">
                      <a style="text-decoration: none;" class="btn btn-all-benefits visible-xs hidden-md hidden-lg" href="{{$homePageBlock->benefits_url}}">All the benefits</a>
                    </div>
                </div>
            </div>
            <div class="benefits-arrow-bottom">
<<<<<<< HEAD
                @if(isset($anchorMobileTo))
                <a href="{{ isset($anchorTo) ? $anchorTo : "#" }}" class="anim-anchor hidden-xs"><img src="img/benefits-arrow-bottom.png"></a>
                <a href="{{ isset($anchorMobileTo) ? $anchorMobileTo : "#" }}" class="anim-anchor visible-xs"><img src="img/benefits-arrow-bottom.png"></a>
                @else
                <a href="{{ isset($anchorTo) ? $anchorTo : "#" }}" class="anim-anchor"><img src="img/benefits-arrow-bottom.png"></a>
                @endif
=======
                <a href="{{ isset($anchorTo) ? $anchorTo : "#" }}" class="anim-anchor"><img src="img/benefits-arrow-bottom.png"></a>
>>>>>>> test
            </div>
        </div>
    </div>
</section>