<div class="cards cards-basket gradient-card-size">
    <div id="cart_item_{{$cartItem->itemHash}}" class="card _cart_item_" data-hash="{{$cartItem->itemHash}}" style="background-image: url('{{$productItem->getImageUrl()}}');">
        <h1 class="card-badge">
            <span>{{\TypiCMS\Modules\Categories\Models\Category::find($cartItem->category_id)->title}}</span>
        </h1>
        <div class="card-info card-info-cut card-info-light">
            <div class="card-bottom-section"></div>
            <div class="open-bg open-bg-light">
                <a href="{{$productItem->getSeoUrl()}}" class="light-open btn-open">Open</a>
            </div>
            <div class="card-details">
                <p class="card-price card-price-light">&pound;@if(isset($cartItem->options['price_final'])){{$cartItem->options['price_final']}}@endif</p><br>
                @if(!$cartItem->is_insurance)
                    <div class="card-details-content">
                        <p class="card-description card-description-light">Size
                            <select class="select-style-dark cart-product-size" autocomplete="off">
                                @if(count($relatedProducts[$cartItem->id]->sizes) > 0)
                                @foreach($relatedProducts[$cartItem->id]->sizes as $size)
                                    <?php $selected = ($size->id == $cartItem->size)? 'selected' : ''; ?>
                                    <option {{$selected}} value="{{ $size->id }}">{{ $size->title }}</option>
                                @endforeach
                                @endif
                            </select>
                        </p>
                        <p class="card-description card-description-light">Color <strong>{{ \TypiCMS\Modules\Colors\Models\Color::find($cartItem->color)->title }}</strong></p>
                        <p class="card-description card-description-light quantity-item-block basket-quantity-text"><span>Quantity:&nbsp;</span>
                            <span class="quantity-adjust">
                                <form class="quantity-item-block" method="POST" action="/basket/increment-item/{{$cartItem->itemHash}}">
                                    <input type="hidden" value="0" name="increment">
                                    <button type="submit" autocomplete="off" class="qty-btn item-decrement btn" @if($cartItem->qty <= 1) disabled="disabled" @endif>-</button>
                                </form>

                                <button id="item_qty_{{$cartItem->itemHash}}" class="qty-btn btn item_qty quantity-item-block no-border-radius">{{ $cartItem->qty }}</button>

                                <form class="quantity-item-block" method="post" action="/basket/increment-item/{{$cartItem->itemHash}}">
                                    <input type="hidden" value="1" name="increment">
                                    <button type="submit" autocomplete="off" class="qty-btn item-increment btn">+</button>
                                </form>
                                <span class="clear"></span>
                            </span>
                        </p>
                        <p id="cart_message_{{$cartItem->itemHash}}" class=""></p>
                    </div>
                @else
                    <p class="card-title card-title-light">{{$cartItem->name}}</p>
                    <p class="card-description card-description-light">{{ ($productItem->summary != null && !empty($productItem->summary)) ? $productItem->summary : '&nbsp;' }}</p>
                @endif

                <div class="card-like"></div>
            </div>
        </div>
    </div>
    <div class="add-basket btn-remove-product-from-basket">
        <a href="javascript:void(0);" onclick="removeItem('{{ $cartItem->getHash() }}')">remove</a>
    </div>
</div>
