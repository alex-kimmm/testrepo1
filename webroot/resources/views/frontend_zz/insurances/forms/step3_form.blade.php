
@if ( \Illuminate\Support\Facades\Session::has('errors') )
    <?php $errors = \Illuminate\Support\Facades\Session::get('errors'); ?>
    {!! implode('', $errors->all('<div id="id-insurance-view-steps-error" class="zz-error zz-error-white">:message</div>')) !!}
    <div>&nbsp;</div>
@endif
{!! BootForm::open()->action( route('cart.addinsurance') )->post()->id("make-claim-form")->attribute('novalidate','novalidate') !!}
<input name="product_id" type='hidden' value="<?php echo $productCover->id;?>" />
<div class="white-div">
    <div class="payment-info">

        @section('_step3_product_data')
        @show

        @section('_step3_user_data')
        <div class="getcaver-inputs">
            <div class="row">
                <span>My name is&nbsp;</span>

                <?php $errClass = (isset($errors) && $errors->has('firstname'))? 'error' : ''; ?>
                <?php $preselectedVal = old('firstname')? old('firstname') : (\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->first_name : '') ?>

                <input  id="first-name"
                        type="text"
                        name="firstname"
                        class="form-control placeholder-fix-edge user-name {{$errClass}}"
                        aria-label="..."
                        data-placement="top"
                        placeholder="First"
                        value="{{$preselectedVal}}"
                        required="required">

                <?php $errClass = (isset($errors) && $errors->has('lastname'))? 'error' : ''; ?>
                <?php $preselectedVal = old('lastname')? old('lastname') : (\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->last_name : '') ?>

                <input
                    id="last-name"
                    type="text"
                    name="lastname"
                    class="form-control placeholder-fix-edge user-name {{$errClass}}"
                    aria-label="..."
                    data-placement="top"
                    placeholder="Surname"
                    value="{{$preselectedVal}}"
                    required="required">

                <span>&nbsp;a UK resident&nbsp;<span class="hidden-xs">at&nbsp;</span></span>


                <?php $errClass = (isset($errors) && $errors->has('postcode'))? 'error' : ''; ?>
                <div class="input-postcode-container postcode {{$errClass}}">

                    <input
                        id="IAddressPostcode"
                        type="text"
                        name="postcode"
                        class="placeholder-fix-edge form-control {{$errClass}}"
                        placeholder="Postcode"
                        data-placement="top"
                        value="{{old('postcode')}}"
                        required="required">

                    <span id="ILookForAddress" class="postcode-btn-container">
                        <button class="btn btn-default" type="button"><i></i></button>
                    </span>
                </div>

            </div>

            <div class="row">
                <div id="IinsurancePostCodeSelectContainer" class="postcode-select-container hidden">
                    @include('frontend_zz.inc.blocks._dropdown_select',[
                        'attributeOptions' => [
                                                'id' => 'postCodeDropDown',
                                                'class' => 'postCodeDropDown',
                                              ],
                        'selectName' => 'postCodeDropDown',
                        'selectItems' => [],
                    ])
                </div>
            </div>

            <div class="row">
                <div class="input">
                    <?php $errClass = (isset($errors) && $errors->has('address1'))? 'error' : ''; ?>
                    <input
                        id="IAddress1"
                        type="text"
                        name="address1"
                        class="form-control placeholder-fix-edge {{$errClass}}"
                        aria-label="..."
                        data-placement="top"
                        placeholder="Address line 1"
                        value="{{old('address1')}}"
                        required="required">
                </div>
            </div>
            <div class="row">
                <div class="input">
                    <?php $errClass = (isset($errors) && $errors->has('address2'))? 'error' : ''; ?>
                    <input
                        id="IAddress2"
                        type="text"
                        name="address2"
                        class="form-control placeholder-fix-edge {{$errClass}}"
                        aria-label="..."
                        data-placement="top"
                        placeholder="Address line 2"
                        value="{{old('address2')}}">
                </div>
            </div>
            <div class="row">
                <div class="input">
                    <?php $errClass = (isset($errors) && $errors->has('town'))? 'error' : ''; ?>
                    <input
                        id="ITown"
                        type="text"
                        name="town"
                        class="form-control placeholder-fix-edge {{$errClass}}"
                        aria-label="..."
                        data-placement="top"
                        placeholder="Town"
                        value="{{old('town')}}"
                        required="required">
                </div>
            </div>
            <div class="row">
                <div class="input">
                    <?php $errClass = (isset($errors) && $errors->has('telno'))? 'error' : ''; ?>
                    <input
                        id="phone-number"
                        name="telno"
                        type="text"
                        class="form-control placeholder-fix-edge {{$errClass}}"
                        aria-label="..."
                        data-placement="top"
                        title="Please enter a valid phone number"
                        placeholder="Phone"
                        value="{{old('telno')}}"
                        pattern="[0-9]*"
                        inputmode="numeric"
                        required="required">
                </div>
            </div>

            <div class="row">
                <div class="input email">
                    <?php $errClass = (isset($errors) && $errors->has('email'))? 'error' : ''; ?>
                    <?php $preselectedVal = old('email')? old('email') : (\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->email : '') ?>

                    <input
                        id="email"
                        type="text"
                        name="email"
                        class="form-control placeholder-fix-edge {{$errClass}}"
                        aria-label="..."
                        data-placement="top"
                        title="Please fill your email"
                        placeholder="Email"
                        value="{{$preselectedVal}}"
                        required="required">

                </div>
            </div>
        </div>
        @show

        <div class="row">
            <div class="yellow-checkbox getcover-checkbox tc-span" data-placement="top" title="Please accept terms">
                <div class="checkbox">
                    <input
                        id="accept_terms"
                        type="checkbox"
                        name="accept_terms"
                        value="1"
                        required="required">

                    <label for="accept_terms"></label>
                </div>
<<<<<<< HEAD
                <label class="for-check" for="accept_terms">I am over 18 &amp; understand the policy
                @if($productCover->category_id == CATEGORY_XS_COVER)
                <a target="_blank" class="terms-cond" href="/xs-cover/terms">T&amp;C’s</a>
                @elseif($productCover->category_id == CATEGORY_GADGET_INSURANCE)
                <a target="_blank" class="terms-cond" href="/gadget-cover/terms">T&amp;C’s</a>
                @endif
                </label>
=======
                <label class="for-check" for="accept_terms">I am over 18 &amp; understand the policy <a target="_blank" class="terms-cond" href="/mobile/tandcs">T&amp;C’s</a></label>
>>>>>>> test
            </div>
        </div>


    </div>
    <button id="insuranceFormSubmit" type="submit" class="btn btn-cover-me">MAKE PAYMENT</button>
</div>
{!! BootForm::close() !!}
