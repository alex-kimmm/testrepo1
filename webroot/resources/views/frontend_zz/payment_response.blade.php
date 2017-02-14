@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Payment'))

@section('main')

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
<<<<<<< HEAD
						<p>Featuring talented emerging artists from around the world. To claim your FREE DOWNLOAD <a class="music-zip" target="_blank" href="{{ url('/ZugarZnap_Music_Album.zip') }}">click here</a></p>
						<p>Stay safer on the road. Put your driving to the test with ZnapTrack. You can also download and get access to the ZnapTrack mobile application for your <a class="music-zip" href="https://itunes.apple.com/gb/app/znaptrack/id1106967353?mt=8" target="_blank">iOS</a> or <a class="music-zip" href="https://play.google.com/store/apps/details?id=com.hubio.zugarznap" target="_blank">Android</a> device.</p>
						@foreach($order->products as $p)
                            @if($p->isInsurance() && $p->isGadgetInsurance())
                            <p>As part of your purchase of your Gadget policy we are in the process of signing you up for your Znapcard® - giving you access to over £2,000 worth of benefits.</p>
                            @endif
						@endforeach
=======
>>>>>>> test
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
						<p>{!! $message !!}</p>
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
