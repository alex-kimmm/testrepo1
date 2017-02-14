<section class="all-benefits2">
    <a id="{{ isset($anchor) ? $anchor : "" }}"></a>
    <div class="container container-1024">
        <div class="row benefits-content">
            <div class="white-div">
                <div class="col-md-6 col-sm-6 col-xs-12 white-div-content second">
                    <div class="top-label first">
                        <span class="general homepage first">{{$homePageBlock->title}}</span>
                    </div>
                    <div class="top-label">
                        <span class="general homepage">{{$homePageBlock->subtitle}}</span>
                    </div>
                    <a class="btn btn-all-benefits" href="{{$homePageBlock->benefits_url}}" style="text-decoration: none">All the benefits</a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 benefits-dog">
                    <div class="benefits-img-dog" style="background-image: url('{{ $homePageBlock->getImageUrl() }}')">&nbsp;</div>
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