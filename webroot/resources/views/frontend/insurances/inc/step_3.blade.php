<section class="row">
    <div class="excess">

        <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
            <div class="more-questions">
                <span>More questions?</span><br>
                <span>Contact us!</span>
            </div>
        </div>

        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
            <div class="make_claim-container excess-container">
                <div class="row">

                    <div class="insurance-form">
                        @if ( \Illuminate\Support\Facades\Session::has('errors') )
                            <?php $errors = \Illuminate\Support\Facades\Session::get('errors'); ?>
                            {!! implode('', $errors->all('<div id="id-insurance-view-steps-error" class="zz-error zz-error-white">:message</div>')) !!}
                            <div>&nbsp;</div>
                        @endif
                        {!! BootForm::open()->action( route('cart.addinsurance') )->post()->id("make-claim-form")->attribute('novalidate','novalidate') !!}

                        <input name="product_id" type='hidden' value="<?php echo $product->id;?>" />

                        {{--<div class="row">--}}
                            <span>I would like </span>  
                            <div class="form-group yellow-input make-claim-select i-would-like">
                                <?php
                                    reset($formatPriceOptions);
                                    $selectedOption = old('price_option_id')? old('price_option_id') : key($formatPriceOptions);

                                    reset($periods);
                                    $pay_period = old('pay_period')? old('pay_period') : key($periods);

                                    $priceCalculated = $optionsPrice[$selectedOption];
                                    if($pay_period == 'month'){
                                        $priceFixed = number_format(\App\Http\Controllers\CartController::$insuranceInitialPrice, 2, '.', '');
                                        $priceRecurring = number_format( (($priceCalculated - $priceFixed) / 11), 2, '.', '');
                                        $priceCalculated =  $priceFixed . " <span style='color: #ffffff; float: unset;'>upfront and then 11 instalments equal to</span> £" . $priceRecurring;
                                    }
                                    else {
                                        $priceCalculated = intval($priceCalculated);
                                    }

                                ?>

                                {!! Form::select('attributeOptionID')->options($formatPriceOptions)->select($selectedOption)
                                    ->attribute('id','price_option_id')
                                    ->attribute('data-placement','top')
                                    ->attribute('title','Please select price option') !!}
                            </div>
                            <span class="new-line-span visible-xs-375"></span>
                            <span class="inline-span">of cover for</span>
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            <span class="new-line-span hidden-xs-375"></span>
                            <span class="inline-span">my gadgets, I’d like to pay&nbsp;</span><span class="gold-color-txt inline-span">£</span><span id="price_to_pay" class="gold-color-txt inline-span">{!! $priceCalculated !!}</span><span class="inline-span"> per</span>
                        {{--</div>--}}

                        <div class="row">
                            <div class="form-group yellow-input make-claim-select month-select">
                                {!! Form::select('pay_period')->options($periods)->select($pay_period)
                                    ->attribute('id','pay_period')
                                    ->attribute('data-placement','left')
                                    ->attribute('title','Please select pay period') !!}
                            </div>
                            <span class="new-line-span visible-xs-375"></span>
                            <span>starting from</span>
                            <div class="form-group yellow-input date-input" id='Idatetimepicker'>
                                <?php $errClass = (isset($errors) && $errors->has('tempinceptiondate'))? 'error' : ''; ?>
                                <input id="tempinceptiondate" readonly="readonly" name="tempinceptiondate" type='text' class="form-control readonly-yellow {{$errClass}}" value="{{old('tempinceptiondate')}}" data-placement="right" title="Please fill date starting with tomorrow"/>
                            </div>
                            <p>and  you can reach me at:  </p>
                        </div>

                        <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group yellow-input email">
                                <?php $errClass = (isset($errors) && $errors->has('email'))? 'error' : ''; ?>
                                <input id="email" type="text" name="email" class="form-control placeholder-fix-edge email-insurance {{$errClass}}" placeholder="email"
                                    value="{{ ( old('email') != "" ) ? old('email') : (\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->email : '') }}" data-placement="right" title="Please fill your email">
                            </div>
                        </div>

                        <div class="row">
                            <span>My name is</span>
                            <span class="new-line-span visible-xs-375"></span>
                            <div class="form-group yellow-input">
                                <?php $errClass = (isset($errors) && $errors->has('firstname'))? 'error' : ''; ?>
                                <input id="first-name" type="text" name="firstname" class="form-control placeholder-fix-edge first-name {{$errClass}}" placeholder="Name"
                                    value="{{ ( old('firstname') != "" ) ? old('firstname') : (\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->first_name : '') }}" required="required">
                            </div>
                            <div class="form-group yellow-input">
                                <?php $errClass = (isset($errors) && $errors->has('lastname'))? 'error' : ''; ?>
                                <input id="last-name" type="text" name="lastname" class="form-control placeholder-fix-edge last-name {{$errClass}}" placeholder="Surname"
                                    value="{{ ( old('lastname') != "" ) ? old('lastname') : (\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->last_name : '') }}" required="required">
                            </div>
                            <span>,</span>
                        </div>

                        <div class="row">
                            <span>a UK resident at</span>
                            <div class="input-group yellow-input" style="margin-bottom: 5px">
                                <?php $errClass = (isset($errors) && $errors->has('postcode'))? 'error' : ''; ?>
                                <input id="IAddressPostcode" type="text" name="postcode" class="form-group placeholder-fix-edge form-control car-number {{$errClass}}"
                                    placeholder="Postcode" value="{{old('postcode')}}" required="required">
                                <span class="input-group-addon margin-right-5px" id="ILookForAddress">
                                    <span class="glyphicon glyphicon-search object-to-center"></span>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div id="IinsurancePostCodeSelectContainer" class="insurance-postcode-wrapper"></div>
                        </div>

                        <div class="row">
                            <div class="form-group yellow-input address">
                                <?php $errClass = (isset($errors) && $errors->has('address1'))? 'error' : ''; ?>
                                <input id="IAddress1" type="text" name="address1" class="form-control placeholder-fix-edge address {{$errClass}}" placeholder="Address line 1" value="{{old('address1')}}" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group yellow-input address">
                                <?php $errClass = (isset($errors) && $errors->has('address2'))? 'error' : ''; ?>
                                <input id="IAddress2" type="text" name="address2" class="form-control placeholder-fix-edge address {{$errClass}}" placeholder="Address line 2" value="{{old('address2')}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group yellow-input town object-min-max-width-100-percents insurance-element-padding-right">
                                    <?php $errClass = (isset($errors) && $errors->has('town'))? 'error' : ''; ?>
                                    <input type="text" name="town" class="form-control placeholder-fix-edge town {{$errClass}}" placeholder="Town" id="ITown" value="{{old('town')}}" required="required" style="width: 100%;">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group yellow-input object-min-max-width-100-percents insurance-element-padding-left" style="margin-left: 0px;">
                                    <?php $errClass = (isset($errors) && $errors->has('telno'))? 'error' : ''; ?>
                                    <input id="phone-number" name="telno" type="text" class="form-control placeholder-fix-edge town" placeholder="Phone" value="{{old('telno')}}" data-placement="bottom" pattern="[0-9]*" inputmode="numeric" title="Please fill your phone" required="required" style="width: 100%;">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                <span>I am over 18 & aware of our <a href="/terms" class="terms-cond">T&C</a></span>
                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 tc-span" data-placement="left" title="Please accept">
                                <div class="yellow-checkbox insurance-checkbox-terms">
                                    <div class="checkbox">
                                        <!-- <label><input type="checkbox"></label> -->
                                        <input id="accept_terms" type="checkbox" name="accept_terms" value="1" required="required">
                                        <label for="accept_terms"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row excess-progress progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        
                        <div class="step3">
                            <div class="insurance-steps">
                                <div class="insurance-buttons">
                                    <button type="button" class="btn" onclick="InsuranceSwipeHandler.toPos(insuranceSwipe, 'step', 0)">1. gadget</button>
                                    <button type="button" class="btn" onclick="InsuranceSwipeHandler.toPos(insuranceSwipe, 'step', 1)">2. benefits</button>
                                    <button type="submit" class="btn current yellow insurance-new-submit">add to basket</button>
                                </div>
                            </div>
                        </div>

                    {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if( $related_product != null )
<section>
    <div class="detail-white-line">
        <p>You might also like these.</p>
    </div>
</section>
@endif

@if( $related_product != null )
<section class="cards-grid">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            @include('frontend.inc._card', ['theme' => 'red-card', 'product' => $related_product, 'cardTheme' => 'light'])
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            <div class="cards blue-card"></div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 hidden-xs">
            <div class="cards purple-card"></div>
        </div>
    </div>
</section>
@endif
