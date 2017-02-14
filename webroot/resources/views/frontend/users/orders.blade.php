@extends('frontend.layouts.app')

@section('title', trans('users::global.Orders') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<br/>
<h4>Account: {{ $user->email }}</h4>
<br/>

@if(Session::has('success'))
<script>
    $(document).ready(function(){
        showNotification("{{ Session::get('success') }}", "body", "success", "top", "right", "auto", null, true);
    });
</script>
@endif

@if(Session::has('fail'))
<script>
    $(document).ready(function(){
        showNotification("{{ Session::get('fail') }}", "body", "danger", "top", "right", "auto", null, true);
    });
</script>
@endif

@if(isset($errors) && count($errors) > 0)
    @include('frontend.responses.errors', [ 'errors' => $errors ])
@endif

<div class="row">
    <div class="col-md-2"> </div>
    <div class="col-md-10">

    TOTAL ORDERS: {{ count($orders) }}

    @if(count($orders) > 0)
        @foreach($orders as $order)
        <ul style="border: 1px solid #000000; margin: 10px; padding: 10px;">

        <label><b>Order ({{ count($order->products) > 1 ? count($order->products) . ' products' : '1 product' }})</b></label>
        <label style="color: #007bff; font-size: 13px;">&nbsp;[ ordered <span style="color: #000000;"><b>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($order->created_at))->diffForHumans() }}</b></span> ]</label>
        @foreach($order->products as $product)
            <ul style="border: 1px solid #000000; margin: 10px; padding: 10px;">
                <label>Product</label>
                <li style="border: 1px solid #000000; margin: 10px; padding: 15px;">
                    <div>
                        <b>Category: {{ $product->category->title }}</b>
                    </div>

                    <div>
                        ID: {{ $product->id }}
                    </div>

                    <div>
                        Product name: {{ $product->title }}
                    </div>

                    <div>
                        Unit Price: {{ $product->price }}
                    </div>

                    <div>
                        Quantity: {{ $product->pivot->quantity }}
                    </div>
                </li>

                @if(count($product->claims) > 0)
                <label><b>Claims</b></label>
                <li style="border: 1px solid #000000; margin: 10px; padding: 10px;">
                    @foreach($product->claims as $claim)
                    <div class="row">
                        <div class="col-md-2">
                            <span style="font-size: 13px;">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($claim->created_at))->diffForHumans() }}</span>
                        </div>
                        <div class="col-md-10">
                            <ol> {{ $claim->description }}</ol>
                        </div>
                        <hr/>
                    </div>
                    @endforeach
                </li>
                @else
                <label><b>No claims</b></label>
                @endif

                @include('frontend.claims.form_create_claim', [ 'action' => '/profile/claim-create', 'order_id' => $order->id, 'product_id' => $product->id])
            </ul>
            @endforeach
        </ul>
        @endforeach
    @else
    <ul style="border: 1px solid #000000; margin: 10px">
    <label><b>No orders</b></label>
    </ul>
    @endif

    </div>
</div>

@endsection