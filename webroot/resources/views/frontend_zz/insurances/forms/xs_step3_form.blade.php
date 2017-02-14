@extends('frontend_zz.insurances.forms.step3_form')

@section('_step3_product_data')

    <div class="row pos-relative">
        <span>I want to cover my car insurance excess for up to</span>

        <?php $selectedPriceOption = old('attributeOptionID')? old('attributeOptionID') : key($productCover->getFormattedPriceOptions());?>

        @include('frontend_zz.inc.blocks._dropdown_select',[
            'attributeOptions' => [
                                    'class' => 'xs-select',
                                  ],
            'selectName' => 'attributeOptionID',
            'selectItems' => $productCover->getFormattedPriceOptions(),
            'selectedItemKey' => $selectedPriceOption,
        ])
        <span>for one year for <span class="bold">£<span id="priceForOption" class="bold">{{$productCover->getFormattedPriceForOptionId($selectedPriceOption)}}</span></span></span>

    </div>
    <span>For my motor vehicle&nbsp;</span>
    <?php $errClass = (isset($errors) && $errors->has('car'))? 'error' : ''; ?>
<<<<<<< HEAD
    <input data-placement="top" id="carNumber" name="car" type="text" class="form-control car-input {{$errClass}}" placeholder="ZZ03 ZEE" value="{{old('car')}}">
<span>&nbsp;starting from&nbsp;</span> <input id="Idatetimepicker" type="text" readonly name="tempinceptiondate" value="{{old('tempinceptiondate')}}" class="datePicker datePickerTomorrowPrepopulate pos-relative">
=======
    <input data-placement="top" id="carNumber" name="car" type="text" class="form-control car-input {{$errClass}}" placeholder="0X 478 450" value="{{old('car')}}">
<span>&nbsp;starting from&nbsp;</span> <input id="Idatetimepicker" type="text" name="tempinceptiondate" value="{{old('tempinceptiondate')}}" class="datePicker datePickerTomorrowPrepopulate pos-relative">
>>>>>>> test

@endsection
