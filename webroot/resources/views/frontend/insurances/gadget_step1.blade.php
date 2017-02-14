

        <div class="row">
            <span>I would like</span>
            <div class="make-claim-select">
                <?php
                    reset($formatPriceOptions);
                    $selectedOption = old('price_option_id')? old('price_option_id') : key($formatPriceOptions);

                    reset($periods);
                    $pay_period = old('pay_period')? old('pay_period') : key($periods);

                    $priceCalculated = $optionsPrice[$selectedOption];
                    if($pay_period == 'month'){
                        $priceCalculated = $priceCalculated / 12;
                    }

                ?>

                {!! Form::select('attributeOptionID')->options($formatPriceOptions)->select($selectedOption)
                    ->attribute('id','price_option_id')
                    ->attribute('data-placement','top')
                    ->attribute('title','Please select price option') !!}

            </div>
            <span>of cover for</span>
        </div>
        <div class="row">
            <span>my gadgets, I’d like to pay <span class="month-pay-nr">£</span><span id="price_to_pay" class="month-pay-nr">{{formatPrice($priceCalculated)}}</span> per</span>
        </div>
        <div class="row">
            <div class="make-claim-select">

                {!! Form::select('pay_period')->options($periods)->select($pay_period)
                    ->attribute('id','pay_period')
                    ->attribute('data-placement','left')
                    ->attribute('title','Please select pay period') !!}
            </div>

            <span>starting from</span>
            <div class='input-group date yellow-input' id='datetimepicker1'>
                <?php $errClass = (isset($errors) && $errors->has('tempinceptiondate'))? 'error' : ''; ?>
                <input name="tempinceptiondate" type='text' class="form-control excess-date {{$errClass}}" value="{{old('tempinceptiondate')}}" data-placement="right" title="Please fill date starting with tomorrow"/>
            </div>

            <span>and you can reach me at:</span>
        <div class="form-group yellow-input user-email">
            <?php $errClass = (isset($errors) && $errors->has('email'))? 'error' : ''; ?>
            <input type="text" name="email" class="form-control placeholder-fix-edge first-name email-field {{$errClass}}" placeholder="email"
                value="{{ (old('email')) ? old('email') : (\Illuminate\Support\Facades\Auth::check()) ? \Illuminate\Support\Facades\Auth::user()->email : "" }}" data-placement="right" title="Please fill your email">
        </div>

        </div>

        <div class="steps-buttons">
            <div class="row excess-steps-bottom">
                <p>Step 1 of 2</p>
            </div>
            <div class="row excess-progress progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
            </div>
            <ul class="list-inline">
                <li class="white-btn">
                    <button id="confirmDetails" class="btn btn-white" type="button">Confirm Details</button>
                </li>

                <li class="white-btn">
                    <button class="btn btn-white disable" type="button">Add to basket</button>
                </li>
            </ul>
        </div>

