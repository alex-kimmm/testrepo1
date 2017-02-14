<div class="cards {{ $theme }} gradient-card-size">
    <div class="card" onclick="javascript:location.href='{{$product->getSeoUrl()}}'" style="cursor: pointer;@if($product->image) background-image: url('{{$product->getImageUrl()}}')@endif">
        <h1 class="card-badge">
            <span>{{$product->category->title}}</span>
        </h1>

        <div class="card-info card-info-{{ $cardTheme }}">
            <div class="open-bg-container">
                <div class="open-bg open-bg-{{ $cardTheme }}">
                    <a href="{{$product->getSeoUrl()}}" class="{{ $cardTheme }}-open btn-open">Open</a>
                </div>
            </div>

            <div class="card-details">
                @if($product->price > 0)
                    <p class="card-price card-price-{{ $cardTheme }}">£{{formatPrice($product->price)}}</p>
                @endif
                <p class="card-title card-title-{{ $cardTheme }}">{{$product->title}}</p>
                <p class="card-description card-description-{{ $cardTheme }}">{{$product->summary}}</p>
                <div class="card-like"></div>
            </div>
        </div>
    </div>
    {{--temporary--}}
    {{--<div class="add-basket hidden-xs">--}}
        {{--<a href="javascript:void(0);" onclick="addToCart('{{$product->id}}', '{{$product->isInsurance()}}')" >Add to basket</a>--}}
    {{--</div>--}}
</div>