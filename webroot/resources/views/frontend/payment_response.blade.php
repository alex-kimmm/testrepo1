@extends('frontend.layouts.app')

@section('title', trans('users::global.Payment'))

@section('main')
@include('frontend.inc._nav')

<section class="cards-grid">



<div class="row">


        <div class="account-mobile-tabs visible-xs">
            <ul class="list-inline">
                <li class="first active"><a href="">checkout</a></li>
                <li><a href="">payment</a></li>
            </ul>
        </div>

        @if(isset($success))
        <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-right">
	        	<div class="checkout confirmed">
	        		<div class="text-center">
		        		<p class="checkout-title">your purchase is confirmed</p>
						<p>You’ll receive an email shortly.</p>
						<p>Your order: <span class="pink-text-color">#{{ $order->ref_number }}</span></p>
	        		</div>

	        		<div class="confirmed-gif" style="background-image: url(https://zugarznap.blob.core.windows.net/failzimages/15/64533acc-27aa-4b50-95b0-0c7e0ec78f66_giphy_beauty_01.gif)"></div>

					<div class="btn-center">
						<a href="/profile/my-orders"><button class="btn btn-yellow-confirm">My Orders</button></a>
					</div>
	        	</div>
	        </div>

	        <div class="col-lg-8 col-md-8 hidden-sm hidden-xs">
	        	<div class="row backet-cards"></div>
	        </div>
        </div>
        @endif


        @if(isset($error))
        <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
	        	<div class="checkout confirmed">
	        		<div class="text-center">
		        		<p class="checkout-title">Purchase unsuccessful</p>
						<p>There has been an error with your order. Please try again later.</p>
	        		</div>


					<div class="btn-center">
						<a href="/basket"><button class="btn btn-yellow-confirm">View your basket</button></a>
					</div>
	        	</div>
	        </div>

	        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	        	<div class="row backet-cards"></div>
	        </div>
        </div>
        @endif

	</div>

</section>

@endsection
