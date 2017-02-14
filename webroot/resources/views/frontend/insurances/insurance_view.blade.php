@extends('frontend.layouts.app')

@section('title', $product->title  . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')


<script type='text/javascript'>
    var optionsPrice = <?php echo \GuzzleHttp\json_encode($optionsPrice,true);?>;
</script>

<section class="row">
	<div class="excess">
        <div class="container">

            @include('frontend.insurances._gadget_sidebar', ['sidebar_blocks' => $sidebar_blocks])

	        <div class="make_claim-container excess-steps">
	        	<div class="row">

                    @include('frontend.insurances._gadget_interactive_cards',['insurance_block'=>$insurance_block])

                    @include('frontend.insurances._interactive_mobile_cards_slidershow',['sidebar_blocks'=>$sidebar_blocks])

                    <div id="id-insurance-view-steps" class="col-lg-6 col-md-6 col-sm-6 col-xs-12 insurance-form">

                        @if ( \Illuminate\Support\Facades\Session::has('errors') )
                            <?php $errors = \Illuminate\Support\Facades\Session::get('errors'); ?>
                            {!! implode('', $errors->all('<div id="id-insurance-view-steps-error" class="zz-error zz-error-white">:message</div>')) !!}
                            <div>&nbsp;</div>
                        @endif

                        {!! BootForm::open()->action( route('cart.addinsurance') )->post()->id("make-claim-form")->attribute('novalidate','novalidate') !!}
                        <div id="insFormStep1">

                            <input name="product_id" type='hidden' value="<?php echo $product->id;?>" />

                            @if($product->category_id == CATEGORY_XS_COVER)
                                @include('frontend.insurances.xscover_step1')
                            @elseif($product->category_id == CATEGORY_GADGET_INSURANCE)
                                @include('frontend.insurances.gadget_step1')
                            @endif
                        </div>
                        <div id="insFormStep2">
                            @include('frontend.insurances.step2')
                        </div>
                    </div>

                    {!! BootForm::close() !!}

	        	</div>
	        </div>
        </div>
    </div>

    @if( $related_product != null )
    <div class="detail-white-line">
        <p>You might also like these.</p>
    </div>
    @endif
</section>

@if( $related_product != null )
<section class="cards-grid">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            @include('frontend.inc._card', ['theme' => 'red-card', 'product' => $related_product, 'cardTheme' => 'light'])
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            <div class="cards blue-card"></div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            <div class="cards purple-card"></div>
        </div>
    </div>
</section>
@endif

@endsection


@section('js')

<script>

// Set up the form object which relates fields to input ID's
var form = {
  "address1" : "Address1",
  "address2" : "Address2",
  "town" : "Town"
};

// Grab the Button element
var myAddress = document.getElementById('LookForAddress');
// Grab the postcode input element
var myPostcode = document.getElementById('AddressPostcode');
// New CraftyClicksForm instance
var CC = new _CraftyClicksForm(1);
// Set form fields
CC.setForm(form);
//setElementToAppendSelectTo
CC.setElementToAppendSelectTo(document.getElementById('insurancePostCodeSelectContainer'));
// Do Search
CC.FrontSearch(myAddress, myPostcode);

</script>

<script type="text/javascript" src="/js/public/interactive-cards.js" ></script>

@endsection