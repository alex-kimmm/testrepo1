@extends('frontend_zz.insurances.forms.step3_form')

@section('_step3_product_data')
    <div class="row pos-relative">

        <?php
            $formattedPriceOptions = $productCover->getFormattedPriceOptions();

            //For gadget we will use only 1 price option
            $selectedPriceOptionId = old('attributeOptionID')? old('attributeOptionID') : key($formattedPriceOptions);

            $priceObj = \App\Http\Controllers\CartController::getPriceObjForProductByPayPeriod($productCover, $selectedPriceOptionId, PAY_PER_PERIOD);

            $priceOptionsPeriods = [
<<<<<<< HEAD
                PAY_PER_PERIOD   => '£'.$priceObj->priceInitial . ' now, then '. $priceObj->priceRecurringNrOfPayPeriods .' instalments of £' . $priceObj->priceRecurring,
                PAY_PER_YEAR    => 'full £'. $priceObj->priceTotal .' today.',
=======
                PAY_PER_YEAR    => 'full £'. $priceObj->priceTotal .' today.',
                PAY_PER_PERIOD   => '£'.$priceObj->priceInitial . ' now, then '. $priceObj->priceRecurringNrOfPayPeriods .' rates of £' . $priceObj->priceRecurring,
>>>>>>> test

            ];
            $selectedPayPeriod = old('pay_period')? old('pay_period') : key($priceOptionsPeriods);
        ?>
        <input type="hidden" value="{{$selectedPriceOptionId}}" name="attributeOptionID">

        <span>Please cover my gadgets for up to <span class="bold">{{$formattedPriceOptions[$selectedPriceOptionId]}}</span> starting&nbsp;</span>
<<<<<<< HEAD
        <input id="Idatetimepicker" type="text" readonly name="tempinceptiondate" value="{{old('tempinceptiondate')}}" class="datePicker datePickerTomorrowPrepopulate pos-relative">
=======
        <input id="Idatetimepicker" type="text" name="tempinceptiondate" value="{{old('tempinceptiondate')}}" class="datePicker datePickerTomorrowPrepopulate pos-relative">
>>>>>>> test
    </div>

    <span>I would like to pay</span>

    <?php $selectedPriceOption = old('attributeOptionID')? old('attributeOptionID') : key($productCover->getFormattedPriceOptions());?>

    @include('frontend_zz.inc.blocks._dropdown_select',[
            'attributeOptions' => [
                                    'class' => 'second payPeriod',
                                  ],
            'selectName' => 'pay_period',
            'selectItems' => $priceOptionsPeriods,
            'selectedItemKey' => $selectedPayPeriod,
        ])
    <br>

<<<<<<< HEAD
    @if( false && $zhit_product)
=======
    @if($zhit_product)
>>>>>>> test
    <?php
     $likeZhitPhoneOptions = [
        LIKE_ZHIT_PHONE_YES => 'I would',
        LIKE_ZHIT_PHONE_NO  => 'I would not',
     ];
    ?>
    @include('frontend_zz.inc.blocks._dropdown_select',[
        'attributeOptions' => [
                                'class' => 'third likeZhitPhone',
                              ],
        'selectName' => 'likeZhitPhone',
        'selectItems' => $likeZhitPhoneOptions,
        'selectedItemKey' => key($likeZhitPhoneOptions),
    ])

    <span>also like a Zhit Phone to take on wild nights out for a one off payment of <span class="bold">£{{$zhit_product->price}}</span></span>
    @endif
@endsection
