<?php $cssClass = ($cartItem->category_id == CATEGORY_GADGET_INSURANCE)?
'green-to-yellow-diagonal-gradient' :
'red-to-orange-diagonal-gradient';
?>

<div class="policy-item cart-item" id="cart_item_{{$cartItem->itemHash}}" data-hash="{{$cartItem->itemHash}}">
    <div class="policy-card {{$cssClass}}">
        <div class="policy-card-inside">
            <div class="policy-card-top">
                <h3 class="policy-product-title">
                    {{\TypiCMS\Modules\Categories\Models\Category::find($cartItem->category_id)->title}}
                </h3>
                <div class="policy-image" style="background-image: url('{{$productItem->getImageUrl()}}');"></div>
            </div>
            <div class="policy-card-body">
                @if( in_array($cartItem->category_id, [CATEGORY_CLOTHING]) )
                    <p class="card-price card-price-light">{{\App\Http\Controllers\CartController::priceTextFormatForCartItem($cartItem)}}</p><br>
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
                @elseif( in_array($cartItem->category_id, [CATEGORY_GADGET_INSURANCE, CATEGORY_XS_COVER]) )
                    <p class="card-title card-title-black card-title-light">
                    @if($cartItem->category_id == CATEGORY_GADGET_INSURANCE)
<<<<<<< HEAD
                        Your gadgets are covered up to {{ $relatedProducts[$cartItem->id]->getFormattedOptionNameForOptionId($cartItem->iwep_data['attributeOptionID']) }} <br>&nbsp;
                    @else
                        Your car excess reimbursement - aggregate limit {{ $relatedProducts[$cartItem->id]->getFormattedOptionNameForOptionId($cartItem->iwep_data['attributeOptionID']) }}
=======
                        Your gadget are covered up to {{ $relatedProducts[$cartItem->id]->getFormattedOptionNameForOptionId($cartItem->iwep_data['attributeOptionID']) }}
                    @else
                        Your car excess is reduced to {{ $relatedProducts[$cartItem->id]->getFormattedOptionNameForOptionId($cartItem->iwep_data['attributeOptionID']) }}
>>>>>>> test
                    @endif
                    </p>
                    <p class="pull-left">{{$cartItem->name}}</p>
                    <p class="pull-right">{{\App\Http\Controllers\CartController::priceTextFormatForCartItem($cartItem)}}</p>
                    <div class="clearfix"></div>
<<<<<<< HEAD

                    <ul class="cart-item-documents">

                        @if(isset($relatedProducts[$cartItem->id]->getOptionsPdfDocuments()['policyFileRef']))
                            <li><a target="_blank" href="{{$relatedProducts[$cartItem->id]->getOptionsPdfDocuments()['policySummaryFileRef']}}" >Key facts</a></li>
                        @endif

                        @if(isset($relatedProducts[$cartItem->id]->getOptionsPdfDocuments()['policyFileRef']))
                            <li><a target="_blank" href="{{$relatedProducts[$cartItem->id]->getOptionsPdfDocuments()['policyFileRef']}}" >Policy wording</a></li>
                        @endif

                        <li><a href="javascript:void(0);" onclick="removeItem('{{ $cartItem->getHash() }}')" >remove</a></li>
                        <div class="clearfix"></div>
                    </ul>
=======
                    <a href="javascript:void(0);" onclick="removeItem('{{ $cartItem->getHash() }}')" class="basket-remove">remove</a>
                    <div class="clearfix"></div>
>>>>>>> test
                @elseif( in_array($cartItem->category_id, [CATEGORY_ZHIT]) )
                    <p class="card-title card-title-black card-title-light">Zhit Phone to take on wild nights out</p>
                    <p class="pull-left">{{$cartItem->name}}</p>
                    <p class="pull-right">{{\App\Http\Controllers\CartController::priceTextFormatForCartItem($cartItem)}}</p>
                    <div class="clearfix"></div>
<<<<<<< HEAD
                    <a href="javascript:void(0);" onclick="removeItem('{{ $cartItem->getHash() }}')" >remove</a>
=======
                    <a href="javascript:void(0);" onclick="removeItem('{{ $cartItem->getHash() }}')" class="basket-remove">remove</a>
>>>>>>> test
                    <div class="clearfix"></div>
                @endif

                <div class="card-like"></div>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>
