@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Basket') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<section class="cards-grid">
    <div class="row">
        @if(count($items))

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
                {!! BootForm::open()->action( route('cart.checkout') )->post()->id('basketForm')->attribute('novalidate','novalidate') !!}
	        	<div class="checkout">

	        	    @if(\Illuminate\Support\Facades\Session::has('error'))
                        <p class="zz-error zz-error-red">{!! \Illuminate\Support\Facades\Session::get('error') !!}</p>
	        	    @endif

                    @if((isset($errors) && $errors->has()))
	        	        <p class="zz-error zz-error-red">{!!$errors->first()!!}</p>
	        	    @endif

	        	    <?php
	        	        $collapseTwo = '';
	        	        if ( $errors->has('deliveryFirstName') ||
                             $errors->has('deliveryEmail') ||
                             $errors->has('deliveryPhone') ||
                             $errors->has('deliveryPostcode') ||
                             $errors->has('deliveryAddress1') ||
                             $errors->has('deliveryCity') )
                             $collapseTwo = 'in';

                        $collapseThree = '';
	        	        if ( $errors->has('billingAsDelivery') ||
                             $errors->has('billingFirstName') ||
                             $errors->has('billingPhone') ||
                             $errors->has('billingPostcode') ||
                             $errors->has('billingAddress1') ||
                             $errors->has('billingCity') )
                             $collapseThree = 'in';

                        $collapseFour = '';
	        	        if ( $errors->has('cardNumber') ||
                             $errors->has('cardStartMonth') ||
                             $errors->has('cardStartYear') ||
                             $errors->has('cardExpireMonth') ||
                             $errors->has('cardExpireYear') ||
                             $errors->has('cardUserName')  ||
                             $errors->has('cardType')  ||
                             $errors->has('cardCVV')
                          )
                             $collapseFour = 'in';

                        $collapseFive = '';
                        if (
                             $errors->has('loginEmail') ||
                             $errors->has('loginPassword') ||
                             $errors->has('accountEmail') ||
                             $errors->has('accountFirstName') ||
                             $errors->has('accountLastName') ||
                             $errors->has('accountPassword') ||
                             $errors->has('accountPassword_confirmation')
                           )
                             $collapseFive = 'in';
	        	    ?>

					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

					  	<div class="panel panel-default">
					    	<div class="panel-heading" role="tab" id="headingOne">
					      		<h4 class="panel-title">
					        		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					        			<div class="total-to-pay">
								        	<span class="checkout-title">Total Payment</span>
								        	<span class="price">&pound; {{ $priceFinal }}</span>
							        	</div>
					        		</a>
					      		</h4>
					    	</div>
						    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						      	<div class="panel-bod total">
						      	    @if($is_recurring)
                                    <div class="row pay-detail">
                                        <span class="title">Paid in {{(\App\Http\Controllers\CartController::$insuranceNrOfPayPeriods + 1)}} instalments </span>
                                    </div>

                                    <div class="row pay-detail">
                                        <span class="title">First payment of</span>
                                        <span class="price">&pound; {{$priceInitial}}</span>
                                    </div>
                                    <div class="row pay-detail">
                                        <span class="title">Followed by {{\App\Http\Controllers\CartController::$insuranceNrOfPayPeriods}} monthly payments of</span>
                                        <span class="price">&pound; {{$recurringPrice}}</span>
                                    </div>
                                    @endif
<<<<<<< HEAD

                                    <div class="row pay-detail">
                                        <span class="title">All prices include IPT, GST and VAT where applicable.</span>
                                    </div>
=======
						      	    @if($is_recurring)
						      	    <br>
								    <div class="row pay-detail">
										<span class="title">And then {{\App\Http\Controllers\CartController::$insuranceNrOfPayPeriods}} rates of</span>
										<span class="price">&pound; {{$recurringPrice}}</span>
									</div>
									@endif
>>>>>>> test

								</div>
						    </div>
					    </div>

					  	<div class="panel panel-default">
					    	<div class="panel-heading" role="tab" id="headingTwo">
					      		<h4 class="panel-title">
					        		<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					          			<p class="checkout-title">DELIVERY DETAILS</p>
					        		</a>
					      		</h4>
					    	</div>

					    	    <div id="collapseTwo" class="panel-collapse collapse {{$collapseTwo}}" role="tabpanel" aria-labelledby="headingTwo">
						      	<div class="panel-body delivery-details">

						      		<div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
										{!! BootForm::text('Delivery First Name', 'deliveryFirstName')->hideLabel()->placeholder('Chloé Husson')->addClass('border-radius-no-left')->defaultValue($defaultData['name'])->attribute('validate', 'notnull') !!}
									</div>

									<div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
						      	        {!! BootForm::text('Delivery Email', 'deliveryEmail')->hideLabel()->placeholder('chloe.husson@gmail.com')->addClass('border-radius-no-left')->defaultValue($defaultData['email'])->attribute('validate', 'notnull|email') !!}
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
						      	        {!! BootForm::text('Delivery Phone', 'deliveryPhone')->hideLabel()->placeholder('04789518458')->addClass('input_digits_only border-radius-no-left')->attribute('validate', 'notnull|phone')->attribute('pattern','\d*')->attribute('inputmode','numeric')->defaultValue($defaultData['telno']) !!}
                                    </div>

						      	    <div class="form-group post-code-cart-wrapper" style="position: relative;">
						      	        <?php $deliveryPostcode = old('deliveryPostcode')? old('deliveryPostcode') : $defaultData['postcode'];?>
						      	        <input type="text" name="deliveryPostcode" id="deliveryPostcode" class="form-control {{ $errors->has('deliveryPostcode') ? 'error' : '' }}" placeholder="postcode" value="{{$deliveryPostcode}}" validate="notnull">
						      	        <span class="input-group-addon" id="LookForAddress" style="cursor: pointer; position: absolute; top: 0; right: 0; width: 37px; height: 34px; z-index: 10">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </span>
						      	    </div>

						      	    <div id="cart-addresses-drop-down" class="form-group post-code-cart-wrapper cart-addresses-drop-down"></div>

                                    <div class="input-group full-width">
						      	        {!! BootForm::text('Delivery Address1', 'deliveryAddress1')->hideLabel()->placeholder('55, charterhouse street')->attribute('validate', 'notnull')->defaultValue($defaultData['address1']) !!}
                                    </div>

                                    <div class="input-group full-width">
						      	        {!! BootForm::text('Delivery City', 'deliveryCity')->hideLabel()->placeholder('ec4584, london, uk')->attribute('validate', 'notnull')->defaultValue($defaultData['town']) !!}
                                    </div>

									<!-- <a href="" class="edit-checkout"><img src="img/dark-pen.png"></a> -->
						      	</div>
					    	</div>
					  	</div>

					  	<div class="panel panel-default">
					    	<div class="panel-heading" role="tab" id="headingThree">
					      		<h4 class="panel-title">
					        		<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					          			<p class="checkout-title">billing address</p>
					        		</a>
					      		</h4>
					    	</div>
					    	<div id="collapseThree" class="panel-collapse collapse {{$collapseThree}}" role="tabpanel" aria-labelledby="headingThree">
						      	<div class="panel-body delivery-details">

                                    <div class="input-group">
                                        <input name="billingAsDelivery" value="0" type="hidden">
                                        <label class="plain-label">
                                        <?php $checked = (old('billingAsDelivery')=='0')? old('billingAsDelivery') : '1'; ?>
                                        @if($checked == '1')
                                            <input type="checkbox" class="billingAsDelivery" name="billingAsDelivery" checked="checked"/>
                                        @else
                                            <input type="checkbox" class="billingAsDelivery" name="billingAsDelivery"/>
                                        @endif
                                        &nbsp;&nbsp;Same as Delivery Address
                                        </label>
                                    </div>

                                    <div class="input-group billingFirstNameContainer">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						      	        {!! BootForm::text('Billing First Name', 'billingFirstName')->hideLabel()->placeholder('Chloé Husson')->addClass('border-radius-no-left')->defaultValue($defaultData['name'])->attribute('validate', 'notnull') !!}
									</div>

                                    <div class="input-group billingPhoneContainer">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
						      	        {!! BootForm::text('Billing Phone', 'billingPhone')->hideLabel()->placeholder('04789518458')->addClass('input_digits_only border-radius-no-left')->defaultValue($defaultData['telno'])->attribute('validate', 'notnull|phone')->attribute('pattern','\d*')->attribute('inputmode','numeric') !!}
                                    </div>

                                    <div class="form-group post-code-cart-wrapper billingPostcodeContainer" style="position: relative;">
                                        <?php $billingPostcode = old('billingPostcode')? old('billingPostcode') : $defaultData['postcode'];?>
                                        <input type="text" name="billingPostcode" id="billingPostcode" class="form-control" placeholder="postcode" value="{{$billingPostcode}}" validate="notnull">
                                        <span class="input-group-addon" id="BillingLookForAddress" style="cursor: pointer; position: absolute; top: 0; right: 0; width: 37px; height: 34px; z-index: 10">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </span>
                                    </div>

                                    <div id="billingAddressesContainer" class="form-group post-code-cart-wrapper billingAddressesContainer"></div>

                                    <div class="input-group full-width">
						      	        {!! BootForm::text('Billing Address1', 'billingAddress1')->hideLabel()->placeholder('55, charterhouse street')->attribute('validate', 'notnull')->defaultValue($defaultData['address1']) !!}
                                    </div>

                                    <div class="input-group full-width">
						      	        {!! BootForm::text('Billing City', 'billingCity')->hideLabel()->placeholder('ec4584, london, uk')->attribute('validate', 'notnull')->defaultValue($defaultData['town']) !!}
                                    </div>

						      	</div>
						    </div>
					  	</div>

					  	<div class="panel panel-default">
					    	<div class="panel-heading" role="tab" id="headingFour">
					      		<h4 class="panel-title">
					        		<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapsefour">
					          			<p class="checkout-title">payment details</p>
					        		</a>
					      		</h4>
					    	</div>
					    	<div id="collapseFour" class="panel-collapse collapse {{$collapseFour}} pay-card" role="tabpanel" aria-labelledby="headingFour">
						      	<div class="panel-body">
						      	    <span class="title">Please enter your card details below in the appropriate boxes.<br><br>
                                       Please note, If you have opted in for recurring payments these will be taken from this card on a monthly basis as per your order agreement.</span>
                                       <div>&nbsp;</div>
							      	<div class="credit-card">
							      		<div class="card-number row">
							      		    <?php
                                                $inputCSSClass = $wraperCSSClass = '';
                                                if (isset($errors) && $errors->has('cardNumber')){
                                                    $inputCSSClass = 'error';
                                                    $wraperCSSClass = 'has-error';
                                                }
                                            ?>
							      		    <div class="input-group {{$wraperCSSClass}}">
							      		        {!! Form::text('cardNumber')->addClass($inputCSSClass)->addClass('form-control input_digits_only')->attribute('id', 'card-number')->attribute('maxlength',20)->attribute('validation-skip',1)->hideLabel() !!}
							      		    </div>
										</div>
										<?php
                                            $wraperCSSClass = $startDateCSSClass = $expireDateCSSClass = '';
                                            if (isset($errors) && $errors->has('cardStartYear')){
                                                $startDateCSSClass = $wraperCSSClass = 'error';
                                            }

                                            if (isset($errors) && $errors->has('cardExpireYear')){
                                                $expireDateCSSClass = $wraperCSSClass ='error';
                                            }
                                        ?>
										<div class="card-valid row {{$wraperCSSClass}}">
											<div class="card-select {{$startDateCSSClass}}">
											    {!! Form::select('cardStartMonth')->options($months)->id('cardStartMonth') !!}
											</div>
											<div class="card-select {{$startDateCSSClass}}">
											    {!! Form::select('cardStartYear')->options($previousYears)->id('cardStartYear') !!}
											</div>

											<div class="expires-end">

												<div class="card-select {{$expireDateCSSClass}}">
												    {!! Form::select('cardExpireMonth')->options($currentMonths)->id('cardExpireMonth') !!}
												</div>
												<div class="card-select {{$expireDateCSSClass}}">
                                                    {!! Form::select('cardExpireYear')->options($nextYears)->id('cardExpireYear') !!}
												</div>
											</div>

											<span class="glyphicon glyphicon-exclamation-sign cart-date-error-sign"></span>

										</div>
										<div style="clear: both;"></div>

										<div class="row name">
											<div class="form-group input-group first-name">
											    {!! Form::text('cardUserName')->addClass('form-control')->placeholder('NAME ON CARD')->attribute('validate', 'notnull') !!}
											</div>
										</div>

                                        <?php
                                            $selectedCardType = old('cardType');
                                            if(is_null($selectedCardType) || !array_key_exists($selectedCardType,$cards)){
                                                reset($cards);
                                                $selectedCardType = key($cards);
                                            }
                                        ?>
										<input type="hidden" id="basket-payment-cardType" name="cardType" value="{{$selectedCardType}}"/>
                                        <div class="dropdown">
                                            <button id="basket-payment-cardType-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                                <img id="basket-payment-cardType-img" src="{{ $cards[$selectedCardType] }}" />
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @foreach($cards as $key => $card)
                                                <li>
                                                    <a onclick="paymentSelectedCard('{{ $key }}', '{{ $card }}');">
                                                        <img src="{{ $card }}"  width="30" height="20"/>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>

										<div class="cvv">

										    <?php
                                                $inputCSSClass = $wraperCSSClass = '';
                                                if (isset($errors) && $errors->has('cardCVV')){
                                                    $inputCSSClass = 'error';
                                                    $wraperCSSClass = 'has-error';
                                                }
										    ?>

											<div class="input-group {{$wraperCSSClass}}">
											     {!! Form::text('cardCVV')->attribute('maxlength',4)->addClass($inputCSSClass)->addClass('form-control input_digits_only')->attribute('validate', 'notnull|cvv') !!}
											</div>
										</div>

							      	</div>

							      	<div class="ssl-comodo">
                                        <a href="https://ssl.comodo.com" target="_blank">
                                            <img src="https://ssl.comodo.com/images/comodo_secure_seal_113x59_transp.png" alt="SSL Certificate" width="113" height="59"><br>
                                            <p>SSL Certificate</p>
                                        </a>
                                    </div>

						      	</div>
						    </div>
					  	</div>

                        @if(!Auth::check())
                            <div id="cartAccountManageSection" class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFive">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                            <p class="checkout-title">Create an account or login</p>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse {{$collapseFive}}" role="tabpanel" aria-labelledby="headingFive">


                                    <?php $accountOption = old('cartAccountOptRadio')? old('cartAccountOptRadio') : CART_OPTION_ACCOUNT_LOGIN; ?>

                                    <div id="cartAccountManageBlock" class="navigation-radio">
                                        <label class="radio-inline @if($accountOption==CART_OPTION_ACCOUNT_LOGIN) active @endif"><input data-tab="#cartLogin" value="{{CART_OPTION_ACCOUNT_LOGIN}}" type="radio" name="cartAccountOptRadio" @if($accountOption==CART_OPTION_ACCOUNT_LOGIN) checked="checked" @endif>Login</label>
                                        <label class="radio-inline @if($accountOption==CART_OPTION_ACCOUNT_CREATE_ACCOUNT) active @endif"><input data-tab="#cartCreateAccount" value="{{CART_OPTION_ACCOUNT_CREATE_ACCOUNT}}" type="radio" name="cartAccountOptRadio" @if($accountOption==CART_OPTION_ACCOUNT_CREATE_ACCOUNT) checked="checked" @endif>Create Account</label>
                                    </div>

                                    <div id="cartLogin" class="panel-body delivery-details tab-pane @if($accountOption==CART_OPTION_ACCOUNT_LOGIN) active @endif">
                                        <div class="input-group full-width">
                                            {!! BootForm::text('Login Email', 'loginEmail')->hideLabel()->placeholder('Email')->attribute('validate', 'notnull|email') !!}
                                        </div>
                                         <div class="input-group full-width">
                                            {!! BootForm::password('Login Password', 'loginPassword')->hideLabel()->placeholder('Password')->attribute('validate', 'notnull') !!}
                                        </div>
                                    </div>
                                    <div id="cartCreateAccount" class="panel-body delivery-details tab-pane  @if($accountOption==CART_OPTION_ACCOUNT_CREATE_ACCOUNT) active @endif">
                                        <div class="input-group full-width">
                                            {!! BootForm::text('Account Email', 'accountEmail')->hideLabel()->placeholder('Email')->attribute('validate', 'notnull|email') !!}
                                        </div>
                                        <p>Please ensure your email address is correct, as details about your purchase will be sent to this address.</p>
                                        <div class="input-group full-width">
                                            {!! BootForm::text('Account First Name', 'accountFirstName')->hideLabel()->placeholder('First Name')->attribute('validate', 'notnull') !!}
                                        </div>
                                        <div class="input-group full-width">
                                            {!! BootForm::text('Account Last Name', 'accountLastName')->hideLabel()->placeholder('Last Name')->attribute('validate', 'notnull') !!}
                                        </div>
                                        <div class="input-group full-width">
                                            {!! BootForm::password('Account Password', 'accountPassword')->hideLabel()->placeholder('Password')->attribute('validate', 'notnull|password') !!}
                                        </div>
                                        <div class="input-group full-width">
                                            {!! BootForm::password('Account Confirm Password', 'accountPassword_confirmation')->hideLabel()->placeholder('Confirm password')->attribute('validate', 'notnull|password') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
					  	@endif


					</div>

					<div class="btn-center">
						{{--<a href="pay-confirmed"></a>--}}
						<button type="submit" class="btn btn-yellow-confirm interactive-button">CONFIRM</button>
					</div>
	        	</div>
	        	{!! BootForm::close() !!}

	        	<!--- Notification -->
	        	<div id="basket-notifications" class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 hidden-by-default">
	        	    <div class="basket-notifications">
	        	        <div class="row basket-parent-info-message">
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <strong id="basket-notifications-message"></strong>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 basket-child-info-message object-align-to-center-vertical">
                                <div class="close" onclick="uiMessage.closeInfoMessage('.basket-notifications');"></div>
                            </div>
	        	        </div>
                    </div>
	        	</div>
                <!--- End Notification -->
	        </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

	        	<div class="row backet-cards">
	        		<h2 class="your-order">your order</h2>
                    <div>&nbsp;</div>

                    @foreach($items as $cartItem)
                        <?php $productItem = \TypiCMS\Modules\Products\Models\Product::find($cartItem->id);?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div>&nbsp;</div>
                            @include('frontend_zz.inc.cards._cart_card', ['cartItem' => $cartItem, 'productItem' => $productItem, 'relatedProducts' => $relatedProducts])
                        </div>
                    @endforeach

                    <div class="clearfix"></div>
                    <div>&nbsp;</div>
	        	</div>

	        </div>
        </div>
        @else
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row backet-cards" style="min-height: 200px;">
                    <h2 class="your-order">
                        <span class="hidden-xs">Your shopping cart is empty!</span>
                        <span class="visible-xs text-center">Your shopping cart is empty!</span>
                    </h2>
                </div>
            </div>
        @endif
	</div>
</section>

@endsection

@section('js')

@if(Session::has('success') || Session::has('fail'))
<script>
    $(document).ready(function(){
        var message = '{{ Session::has('success') ? Session::get('success') : Session::get('fail') }}';
        uiMessage.showInfoMessage('#basket-notifications', '#basket-notifications-message', message, true, 0);
    });
</script>
<?php Session::forget('success'); ?>
<?php Session::forget('fail'); ?>
@endif

<script type="text/javascript">

    var confirmMessageDeleteProduct = "Do you really want to remove this item from your basket?";
    var successClassMessages = new Array ();
    successClassMessages[0] = "zz-message";
    //successClassMessages[1] = "zz-message-white";
    var errorClassMessages = new Array ();
    errorClassMessages[0] = "zz-error";
    //errorClassMessages[1] = "zz-error-white";

    // Set up the form object which relates fields to input ID's
    var form = {
      "address1" : "deliveryAddress1",
      "town" : "deliveryCity"
    };
    var form2 = {
      "address1" : "billingAddress1",
      "town" : "billingCity"
    };

    // Grab the Button element
    var myAddress = document.getElementById('LookForAddress');
    var myAddress2 = document.getElementById('BillingLookForAddress');
    // Grab the postcode input element
    var myPostcode = document.getElementById('deliveryPostcode');
    var myPostcode2 = document.getElementById('billingPostcode');
    // New CraftyClicksForm instance
    var CC = new _CraftyClicksForm(1);
    var CC2 = new _CraftyClicksForm(1);
    // Set form fields
    CC.setForm(form);
    CC2.setForm(form2);

    //Set element to Append to
    CC.setElementToAppendSelectTo(document.getElementById('cart-addresses-drop-down'));
    CC2.setElementToAppendSelectTo(document.getElementById('billingAddressesContainer'));

    // Do Search
    CC.FrontSearch(myAddress, myPostcode);
    CC2.FrontSearch(myAddress2, myPostcode2);

    function cartAccountManage(){
        this.cartAccountManageSection = $('#cartAccountManageSection');
        if(this.cartAccountManageSection.length){
            this.cartAccountManageBlock = this.cartAccountManageSection.find('#cartAccountManageBlock');
            this.optionRadioGroup = $('input[name="cartAccountOptRadio"]:radio');

            this.optionLabels = this.cartAccountManageBlock.find('label');
            this.tabPanes = this.cartAccountManageSection.find('.tab-pane');
            this.tabPanes = [
                $('#cartLogin'),
                $('#cartCreateAccount')
            ];
            var selectedOption = parseInt($('input[name="cartAccountOptRadio"]:radio:checked').val());
            this.htmlToSave = this.tabPanes[(selectedOption+1)%2].html();
            this.tabPanes[(selectedOption+1)%2].html('');

            this.initAction();
        }
    }

    cartAccountManage.prototype.initAction = function() {
        var $self = this;
        this.optionRadioGroup.on( "change", function(){
            var selectedOption = parseInt($(this).val());

            $self.tabPanes[selectedOption].addClass('active');
            $self.tabPanes[selectedOption].html($self.htmlToSave);
            $self.htmlToSave = $self.tabPanes[(selectedOption+1)%2].html();
            $self.tabPanes[(selectedOption+1)%2].html('');
            $self.tabPanes[(selectedOption+1)%2].removeClass('active');

            $self.optionLabels.removeClass('active');
            $(this).closest('label').addClass('active');
        });
    };


    $(document).ready(function() {

        new cartAccountManage();

        $('#basketForm').on('change', '.CCFormSelect', function() {

            var $deliveryAddress1 = $('#deliveryAddress1');
            var $deliveryCity = $('#deliveryCity');
            var $billingAddress1 = $('#billingAddress1');
            var $billingCity = $('#billingCity');

            setTimeout(function() {

                if($deliveryAddress1.hasClass('error') && $deliveryAddress1.val() != "") {
                    $deliveryAddress1.removeClass('error');
                    if($deliveryAddress1.next().hasClass('form-control-feedback')) {
                        $deliveryAddress1.next().remove();
                    }
                }

                if($deliveryCity.hasClass('error') && $deliveryCity.val() != "") {
                    $deliveryCity.removeClass('error');
                    if($deliveryCity.next().hasClass('form-control-feedback')) {
                        $deliveryCity.next().remove();
                    }
                }

                if($billingAddress1.hasClass('error') && $billingAddress1.val() != "") {
                    $billingAddress1.removeClass('error');
                    if($billingAddress1.next().hasClass('form-control-feedback')) {
                        $billingAddress1.next().remove();
                    }
                }

                if($billingCity.hasClass('error') && $billingCity.val() != "") {
                    $billingCity.removeClass('error');
                    if($billingCity.next().hasClass('form-control-feedback')) {
                        $billingCity.next().remove();
                    }
                }
            }, 200);

        });

        BasketValidator.init("#basketForm");
        billingPrepareCartForm();

        $( ".cart-item-select" ).change(function() {
            var hash = $(this).closest('.cart-item').data('hash');
            var value = $(this).val();

            if( typeof hash == 'undefined' || typeof value == 'undefined' ) return;

            updateItem(hash, 'qty', value);
        });

        /*
        $( ".item-decrement" ).on( "click", function(){
            var hash = $(this).closest('._cart_item_').data('hash');
            disableButtonsForItem(hash);
            incrementItem(hash,false);
        });

        $( ".item-increment" ).on( "click", function(){
            var hash = $(this).closest('._cart_item_').data('hash');
            disableButtonsForItem(hash);
            incrementItem(hash,true);
        });*/

        $( ".cart-product-size" ).change(function() {
            var hash = $(this).closest('._cart_item_').data('hash');
            var value = $(this).val();

            if(
                (typeof hash  === typeof undefined || hash  === false || hash  == "") ||
                (typeof value === typeof undefined || value === false || value == "")
            ) {
                return;
            }

            disableButtonsForItem(hash);

            updateItem(hash, 'size', value);
        });

        $('.billingAsDelivery').change(function() {
            billingPrepareCartForm();
        });
    });

    function billingPrepareCartForm() {

        var deliveryFirstName = $('#deliveryFirstName').val();
        var deliveryEmail = $('#deliveryEmail').val();
        var deliveryPhone = $('#deliveryPhone').val();
        var deliveryPostcode = $('#deliveryPostcode').val();
        var deliveryAddress1 = $('#deliveryAddress1').val();
        var deliveryCity = $('#deliveryCity').val();

        var $billingAsDelivery = $('.billingAsDelivery');
        var $billingFirstNameContainer = $('.billingFirstNameContainer');
        var $billingFirstName = $('#billingFirstName');
        var $billingPhoneContainer = $('.billingPhoneContainer');
        var $billingPhone = $('#billingPhone');
        var $billingPostcodeContainer = $('.billingPostcodeContainer');
        var $billingAddressesContainer = $('.billingAddressesContainer');
        var $billingPostcode = $('#billingPostcode');
        var $billingAddress1 = $('#billingAddress1');
        var $billingCity = $('#billingCity');


        if($billingAsDelivery.is(":checked")) {
            $billingFirstName.attr('validation-skip', 'true');
            $billingPhone.attr('validation-skip', 'true');
            $billingPostcode.attr('validation-skip', 'true');
            $billingAddress1.attr('validation-skip', 'true');
            $billingCity.attr('validation-skip', 'true');

            $billingFirstNameContainer.hide();
            $billingPhoneContainer.hide();
            $billingAddressesContainer.hide();
            $billingPostcodeContainer.hide();
            $billingAddress1.parent().hide();
            $billingCity.parent().hide();
        }
        else {
            $billingFirstNameContainer.show();
            $billingPhoneContainer.show();
            $billingPostcodeContainer.show();
            $billingAddressesContainer.show();
            $billingAddress1.parent().show();
            $billingCity.parent().show();

            $billingFirstName.removeAttr('validation-skip');
            $billingPhone.removeAttr('validation-skip');
            $billingPostcode.removeAttr('validation-skip');
            $billingAddress1.removeAttr('validation-skip');
            $billingCity.removeAttr('validation-skip');
        }
    }

    function getCartItemCard(hash){
        return $('#cart_item_' + hash);
    }

    function disableButtonsForItem(hash){
        var $cartItem = getCartItemCard(hash);
        if($cartItem.length){
            $cartItem.find('.cart-product-size').prop('disabled', true);
            $cartItem.find('.item-decrement').prop('disabled', true);
            $cartItem.find('.item-increment').prop('disabled', true);
        }
    }

    function enableButtonsForItem(hash){
        var $cartItem = getCartItemCard(hash);
        if($cartItem.length){
            $cartItem.find('.cart-product-size').prop('disabled', false);
            $cartItem.find('.item-decrement').prop('disabled', false);
            $cartItem.find('.item-increment').prop('disabled', false);
        }
    }

    function removeItem(hash) {

            if(!confirm(confirmMessageDeleteProduct)) {
                $('.btn-remove-product-from-basket').children().css('color', '#ff0078'); // forced
                return;
            }

            $.ajax({
                url : '/basket/removeitem/' + hash,
                method : 'post',
                beforeSend : function() {
                    // todo : show loader, set interactions to false
                }
            })
            .done(function(rsp) {
                if(rsp.status == 1) {
                    window.location.reload();
                    showNotification("Product was removed.", "body", "success", "top", "right", "auto", null, true);
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

    function updateItem(hash, key, value) {

            $.ajax({
                url : '/basket/update-item/' + hash,
                method : 'post',
                data : { key : key, value : value },
                beforeSend : function() {
                    // todo : show loader, set interactions to false
                }
            })
            .done(function(rsp) {
                if(rsp.status == 1) {
                    location.reload();
                }
                else {
                }
            })
            .fail(function(rsp) {
                enableButtonsForItem(hash);
            })
            .always(function() {
                // todo : hide loader, set interactions to true
            });
    }

    function incrementItem(hash, increment) {
            var card = "#cart_message_" + hash;
            var counter = 0;
            $.ajax({
                url : '/basket/increment-item/' + hash,
                method : 'post',
                data : { increment : increment? 1 : 0 },
                beforeSend : function() {
                    // todo : show loader, set interactions to false
                }
            })
            .done(function(rsp) {
                if(rsp.status == 1) {
                    counter = rsp.data.qty;
                    if(rsp.data.qty == 0){
                        location.reload();
                    } else {
                        $('#item_qty_' + hash).html(rsp.data.qty);
                        cartMessage(card, successClassMessages, "Product was updated successfully.");
                    }
                } else {
                 // todo
                 cartMessage(card, errorClassMessages, "Please, try again later.");
                }
            })
            .fail(function(rsp) {
                enableButtonsForItem(hash);
            })
            .always(function() {
                // todo : hide loader, set interactions to true
                enableButtonsForItem(hash);
                getCartItemCard(hash).find('.item-decrement').prop('disabled', (counter == 1));
            });
    }

    function cartMessage(card, classes, messageText){
        for(var i = 0; i < classes.length; i++){
            $(card).addClass(classes[i]);
        }
        $(card).html(messageText);
    }

</script>

@endsection