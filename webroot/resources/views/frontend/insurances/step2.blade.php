

    <div class="row">
        <span>My name is</span>
        <div class="form-group yellow-input">
            <?php
                $errClass = (isset($errors) && $errors->has('firstname'))? 'error' : '';
                $first_name = ($errClass == 'error') ? old('firstname') : Auth::check() ? Auth::user()->first_name : '';
            ?>
            <input type="text" name="firstname" class="form-control placeholder-fix-edge first-name {{$errClass}}" placeholder="Name" value="{{ $first_name }}" required="required">
        </div>
        <div class="form-group yellow-input">
            <?php
                $errClass = (isset($errors) && $errors->has('lastname'))? 'error' : '';
                $last_name = ($errClass == 'error') ? old('lastname') : Auth::check() ? Auth::user()->last_name : '';
            ?>
            <input type="text" name="lastname" class="form-control placeholder-fix-edge surname {{$errClass}}" placeholder="Surname" value="{{ $last_name }}" required="required">
        </div>
        <span>,</span>
    </div>

    <div class="row">
        <span>a UK resident at</span>
        <div class="form-group yellow-input" style="margin-left: 0;">
            <div class="input-group yellow-input">
                <?php $errClass = (isset($errors) && $errors->has('postcode'))? 'error' : ''; ?>
                <input id="AddressPostcode" type="text" name="postcode" class="form-control placeholder-fix-edge excess-date form-control postcode {{$errClass}}"
                    placeholder="Postcode" value="{{old('postcode')}}" required="required" style="border-radius: 8px 0px 0px 8px !important;">
                <span class="input-group-addon object-left-border-radius-8 margin-right-5px" id="LookForAddress">
                    <span class="glyphicon glyphicon-search object-to-center"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="insurancePostCodeSelectContainer" class="form-group yellow-input insurance-postcode-wrapper"></div>
    </div>

    <div class="row">
        <div class="form-group yellow-input">
             <?php $errClass = (isset($errors) && $errors->has('address1'))? 'error' : ''; ?>
            <input id="Address1" type="text" name="address1" class="form-control placeholder-fix-edge address {{$errClass}}" placeholder="Address line 1" value="{{old('address1')}}" required="required">
        </div>
    </div>

    <div class="row">
        <div class="form-group yellow-input">
             <?php $errClass = (isset($errors) && $errors->has('address2'))? 'error' : ''; ?>
            <input id="Address2" type="text" name="address2" class="form-control placeholder-fix-edge address {{$errClass}}" placeholder="Address line 2" value="{{old('address2')}}">
        </div>
    </div>

    <div class="row">
        <div class="form-group yellow-input">
            <?php $errClass = (isset($errors) && $errors->has('town'))? 'error' : ''; ?>
            <input type="text" name="town" class="form-control placeholder-fix-edge town {{$errClass}}" placeholder="Town" id="Town" value="{{old('town')}}" required="required">
        </div>
        <div class="form-group yellow-input">
            <?php $errClass = (isset($errors) && $errors->has('telno'))? 'error' : ''; ?>
            <input id="phone-number" name="telno" type="text" class="form-control placeholder-fix-edge town" placeholder="Phone" value="{{old('telno')}}" pattern="[0-9]*" inputmode="numeric" data-placement="bottom" title="Please fill your phone" required="required">
        </div>
    </div>

    <div class="row">
        <span class="iam18-span" data-placement="bottom" title="Please confirm">I am over 18 </span>
        <div class="yellow-checkbox">
            <div class="checkbox">
                <!-- <label><input type="checkbox"></label> -->
                <input id="iam18" type="checkbox" name="iam18" value="1" required="required">
                <label for="iam18"></label>
            </div>
        </div>
    </div>

    <div class="row">
        <span class="tc-span" data-placement="bottom" title="Please accept T&C">& I am  aware of the <a href="/terms" class="terms-cond">T&C’s</a></span>
        <div class="yellow-checkbox">
            <div class="checkbox">
                <!-- <label><input type="checkbox"></label> -->
                <?php $errClass = (isset($errors) && $errors->has('telno'))? 'error' : ''; ?>
                <input id="accept_terms" class="{{$errClass}}" type="checkbox" name="accept_terms" value="1" required="required">
                <label for="accept_terms"></label>
            </div>
        </div>
    </div>

    <div class="row excess-steps-bottom">
        <p>Step 2 of 2</p>
    </div>
    <div class="row excess-progress progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
    </div>
    <ul class="list-inline">
        <li class="white-btn">
            <button id="backToDetails" class="btn btn-white" type="button">Back to details</button>
        </li>

        <li class="white-btn">
            <button class="btn btn-white insurance-submit">Add to basket</button>
        </li>
    </ul>
