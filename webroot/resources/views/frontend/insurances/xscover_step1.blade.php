
        <div class="row">
            <span>I would like</span>
            <div class="make-claim-select">

            <?php
                reset($formatPriceOptions);
                $selectedOption = old('attributeOptionID')? old('attributeOptionID') : key($formatPriceOptions);

                $priceCalculated = $optionsPrice[$selectedOption];
            ?>

            {!! Form::select('attributeOptionID')->options($formatPriceOptions)->select($selectedOption)
                ->attribute('id','price_option_id')
                ->attribute('data-placement','top')
                ->attribute('title','Please select price option')  !!}

            </div>
            <span>of cover</span>
            <span>&nbsp;to pay&nbsp;</span><span class="month-pay-nr">£</span><span id="price_to_pay" class="month-pay-nr">{{formatPrice($priceCalculated)}}</span>
            <span>for my motor vehicle</span>
            <div class="input-group yellow-input">
                <?php $errClass = (isset($errors) && $errors->has('car'))? 'error' : ''; ?>
                <input name="car" type="text" class="form-control car-number {{$errClass}}" placeholder="0X 478 450" value="{{old('car')}}" data-placement="top" title="Please fill car number">
            </div>
            <span>starting from</span>

            <div class="form-group">
                <div class='input-group date yellow-input' id='datetimepicker1'>
                    <?php $errClass = (isset($errors) && $errors->has('tempinceptiondate'))? 'error' : ''; ?>
                    <input name="tempinceptiondate" type="text" class="form-control excess-date {{$errClass}}" value="{{old('tempinceptiondate')}}" data-placement="left" title="Please fill date starting with tomorrow"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                 </div>
            </div>
        </div>

        <div class="row">
            <p>Step 1 of 2</p>
        </div>
        <div class="row excess-progress progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
        </div>
        <ul class="list-inline">
            <li class="white-btn">
                <button id="confirmDetails" class="btn btn-white" type="button">Confirm details</button>
            </li>

            <li class="white-btn">
                <button class="btn btn-white disable" type="button">Add to basket</button>
            </li>
        </ul>
