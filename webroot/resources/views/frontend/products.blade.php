@extends('frontend.layouts.app')

@section('title', trans('users::global.Products'))

@section('main')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

{{-- todo : show existing cart with products --}}
Cart items: <span class="cart-count">{{ \LukePOLO\LaraCart\Facades\LaraCart::count($withItemQty = true)}}</span> |
<span><a href="/basket">View cart</a></span> |
<span><a href="javascript:destroyCart();">Remove all</a></span>
<div class="cart-items"></div>
<hr>

<ul>
@foreach($products as $product)
    <li style="border: 1px solid #000000; margin: 10px">
    <div>
        ID: {{$product->id}}
    </div>
    <div>
        Title: {{$product->title}}
    </div>
    <div>
        Price: {{$product->price}}
    </div>

    <?php
        $is_insurance = $product->isInsurance();
    ?>

    @if( $is_insurance )
        <button onclick="addToCart('{{$product->id}}', '{{$is_insurance}}')">Add to cart</button>
    @else
        <div>
        Quantity:
        <select class="quantity quantity-{{$product->id}}">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
        </select>

        </div>
        <div>
            Color:
            @foreach($product->colors as $color)
            <label> {{ $color->title }}
                <input type="radio" class="color" name="color-{{$product->id}}" value="{{ $color->id }}">
            </label>
            @endforeach
        </div>
        <div>
            Size:
            @foreach($product->sizes as $size)
            <label> {{ $size->title }}
                <input type="radio" class="size" name="size-{{$product->id}}" value="{{ $size->id }}">
            </label>
            @endforeach
        </div>
        <button onclick="addToCart('{{$product->id}}', '{{$is_insurance}}')">Add to cart</button>
    @endif
    </li>
@endforeach
</ul>

<script type="text/javascript">

    function addToCart(pID, isInsurance) {

        if( typeof pID == 'undefined' || typeof isInsurance == 'undefined' ) return;

        var data;

        if(isInsurance) {
            // insurance
            data = { id : pID };
        }
        else {
            // clothes

            var quantity = $('.quantity-' + pID).val();
            var color = $('input[name=color-' + pID + ']:checked').val();
            var size = $('input[name=size-' + pID + ']:checked').val();

            if(quantity == "" || color == "" || size == "" || typeof color == 'undefined' || typeof size == 'undefined') {
                showNotification("Please select quantity, color and size.", "body", "danger", "top", "right", "auto", null, true);
                return;
            }

            data = { id : pID, quantity : quantity, attr : { color : color, size : size } };
        }

        $.ajax({
            url : '/basket/add',
            method : 'post',
            data : data,
            beforeSend : function() {
                // todo : show loader, set interactions to false
            }
        })
        .done(function(rsp) {
            if(rsp.status == 1 && typeof rsp.data.items_count != 'undefined') {
                $('.cart-count').text(rsp.data.items_count);
                showNotification("In your cart was added a new product.", "body", "success", "top", "right", "auto", null, true);
            }
            else {
                showNotification(rsp.data.error_message, "body", "danger", "top", "right", "auto", null, true);
            }
        })
        .fail(function(rsp) {
            showNotification(rsp.data.error_message, "body", "danger", "top", "right", "auto", null, true);
        })
        .always(function() {
            // todo : hide loader, set interactions to true
        });
    }

    function destroyCart() {

        if(confirm("Are you sure?")) {
            $.ajax({
                url : '/basket/destroy',
                method : 'get',
                beforeSend : function() {
                    // todo : show loader, set interactions to false
                }
            })
            .done(function(rsp) {
                if(rsp.status == 1) {
                    $('.cart-count').text(0);
                    showNotification("Your cart was destroyed successfully.", "body", "success", "top", "right", "auto", null, true);
                }
                else {
                    showNotification(rsp.data.error_message, "body", "danger", "top", "right", "auto", null, true);
                }
            })
            .fail(function(rsp) {
                showNotification(rsp.data.error_message, "body", "danger", "top", "right", "auto", null, true);
            })
            .always(function() {
                // todo : hide loader, set interactions to true
            });
        }
    }

</script>
@endsection