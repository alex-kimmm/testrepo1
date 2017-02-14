<?php
?>
<div class="detail-card">
    <input type="text" id="clothe-product-quantity" class="hidden" value="1"/>
    @if(count($product->colors) > 0)
    <input type="text" id="clothe-product-color" class="hidden" value="{{ $product->colors[0]->id }}"/>
    @else
    <input type="text" id="clothe-product-color" class="hidden" value="0"/>
    @endif
    <input type="text" id="clothe-product-size" class="hidden" value="0"/>

    <div class="details-dark-mobile visible-xs">
        <div class="details-text-info">
            <h3>{{ $product->title }}</h3>
            <h3 class="yellow">Category: {{ $product->category->title }}</h3>
            @if($product->summary)
                <div class="product-summary">{{ $product->summary }}</div>
            @endif
            <div class="row object-margin-top-minus-15px">
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                    <div class="select-style first">
                        <select id="clothe-product-size-mobile" class="selectpicker" onchange="clotheProductSelectSize(this)" required="required">
                            <option value="0">Select size</option>
                            @if(count($product->sizes) > 0)
                            @foreach($product->sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->title }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                    <div class="select-style">
                        <select id="clothe-product-color-mobile" class="selectpicker">
                            <option value="0">Select color</option>
                            @if(count($product->colors) > 0)
                            @foreach($product->colors as $key=>$color)
                                <option value="{{ $color->id }}" {{ $key == 0 ? 'selected' : '' }}>{{ $color->title }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            <div class="price">£{{ $product->price }}</div>
            <button class="btn btn-yellow visible-xs clothing-add-button" onclick="addToCart('{{ $product->id }}', '{{ $product->isInsurance() }}')">
                Add to basket
            </button>
            <div class="added-to-basket"></div>
        </div>
    </div>

    <div class="card-images">
        <ul class="list-group list-images">
            @if($product->image)
            <li class="list-group-item">
                <a href="#" onclick="clothingChangeProductImage('{{ asset($product->getImageUrl()) }}')">
                    <img src="{{ asset($product->getImageUrl()) }}">
                </a>
            </li>
            @endif
            @if(count($product->images) > 0)
            @foreach($product->images as $productImage)
            <li class="list-group-item">
                <a href="#" onclick="clothingChangeProductImage('{{ asset($productImage->getImageUrl()) }}')">
                    <img src="{{ asset($productImage->getImageUrl()) }}">
                </a>
            </li>
            @endforeach
            @endif
        </ul>
    </div>

    <div class="details-dark-block hidden-xs">
        <div class="list-group-block">
            <ul class="list-group list-colors">
                @if(count($product->colors) > 0)
                <?php $i = 0; ?>
                @foreach($product->colors as $color)
                @if($i == 0)
                <script>
                    var clotheProductOldColor = '#clothe-product-color-desktop-{{ $color->id }}';
                </script>
                @endif
                <li class="list-group-item list-color" style="background-color: #{{ $color->color_code }}; border-radius: 90%; position: relative;">
                    <a id="clothe-product-color-desktop-{{ $color->id }}" class="{{ $i == 0 ? 'active' : '' }}" href="#" title="{{ $color->title }}" data-toggle="tooltip" data-placement="left"
                        onclick="clotheProductSelectColor_Desktop(this, '{{ $color->id }}', '{{ $color->title }}')" style="position: absolute; top: 0; left: 0;"></a>
                </li>
                <?php $i++; ?>
                @endforeach
                @endif
            </ul>
        </div>


        <div class="details-text-info">
            <h3>{{ $product->title }} </h3>
            <h3 class="yellow">Category: {{ $product->category->title }}</h3>
            @if(count($product->colors) > 0)
            <h4 id="clothe-product-color-selected-desktop" class="">Color: {{ $product->colors[0]->title }}</h4>
            @else
            <h4 id="clothe-product-color-selected-desktop" class="">Color: </h4>
            @endif
            @if( $product->summary )
                <div class="product-summary">{{ $product->summary }}</div>
            @endif
            <div class="select-style object-margin-top-15px">
                <select id="clothe-product-size-desktop" class="selectpicker" onchange="clotheProductSelectSize(this)" required="required">
                    <option value="">Please select size</option>
                    @if(count($product->sizes) > 0)
                    @foreach($product->sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->title }}</option>
                    @endforeach
                    @endif
                </select>
            </div>

            <div class="price">£{{ $product->price }}</div>
            <button class="btn btn-yellow clothing-add-button" onclick="addToCart('{{ $product->id }}', '{{ $product->isInsurance() }}')">Add to basket</button>
            <div class="added-to-basket"></div>
        </div>
    </div>

    <div class="card-img-view">
        <div id="id-card-clothing-details" class="card-clothing-detail" style="background-image: url({{ asset($product->getImageUrl($product->id, $product->image)) }})"></div>
    </div>
</div>