@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Insurance') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<div class="getcove">
    <div class="insurance-about">
    @include('frontend_zz.insurances.inc.header_block', [ 'step' => 3, 'insurancePage' => $insurancePageGetCover ])
    </div>

    <section id="b2" class="all-benefits insurance-all-benefits">
        <div class="container container-1024">
            <div class="row benefits-content">

                @if($productCover->category_id == CATEGORY_XS_COVER)
                    <div class="col-md-8 col-sm-8 col-xs-12 getcover-form car-cover-form">
                        @include('frontend_zz.insurances.forms.xs_step3_form')
                    </div>
                @elseif($productCover->category_id == CATEGORY_GADGET_INSURANCE)
                    <div class="col-md-8 col-sm-8 col-xs-12 getcover-form">
                        @include('frontend_zz.insurances.forms.gadget_step3_form')
                    </div>
                @endif


                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="cover-me">
                        @forelse($insurancePageGetCover->insuranceBlocks as $insuranceBlock)
                            @include('frontend_zz.insurances.inc.step3_block', [ 'insuranceBlock' => $insuranceBlock ])
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend_zz.inc._financial-services')

    {{--@if(count($insurancePageGetCover->cards) > 0)--}}
    {{--@include('frontend_zz.inc.cards._stuff-cards-desktop', [ 'stuffCards' => $insurancePageGetCover->cards ])--}}
    {{--@include('frontend_zz.inc.cards._stuff-cards-mobile',  [ 'stuffCards' => $insurancePageGetCover->cards ])--}}
    {{--@endif--}}
</div>

@endsection


@section('js')

<script>

    $(document).ready(function() {
<<<<<<< HEAD

        new postCodeDropDown();

=======
>>>>>>> test
        // go to insurance - get cover form
        var scrollValue = $('.insurance-all-benefits').offset();
        goToScroll('html, body', scrollValue.top, 500);

<<<<<<< HEAD
        new InsuranceFormValidation();
=======
        InsuranceFormValidation.init();
>>>>>>> test
        var scrollToForm = window.localStorage.getItem('scrollToForm');
        if(scrollToForm) {
            var to = $('#make-claim-form').offset().top - $('#main-navigation').outerHeight();
            goToScroll('html, body',to + 'px', 500);
            localStorage.removeItem('scrollToForm');
        }
    });

    // Set up the form object which relates fields to input ID's
    var form = {
      "address1" : "IAddress1",
      "address2" : "IAddress2",
      "town" : "ITown"
    };

    // Grab the Button element
    var myAddress = document.getElementById('ILookForAddress');
    // Grab the postcode input element
    var myPostcode = document.getElementById('IAddressPostcode');
    // New CraftyClicksForm instance
    var CC = new _CraftyClicksForm(1);
    // Set form fields
    CC.setForm(form);
    //setElementToAppendSelectTo
    CC.setElementToAppendSelectTo(document.getElementById('IinsurancePostCodeSelectContainer'));
    // Do Search
    CC.FrontSearch(myAddress, myPostcode);

</script>

@if($productCover->category_id == CATEGORY_XS_COVER)
    <script>
        function getPriceForOption(attributeOptionId){
                var pricesForOption = JSON.parse('<?php echo \GuzzleHttp\json_encode($productCover->getFormattedPrices(),true) ?>');
                return pricesForOption[attributeOptionId];
            }

            $(document).ready(function() {
                $( '[name="attributeOptionID"]' ).change(function() {
                    $('#priceForOption').html( getPriceForOption($(this).val()) );
                });
            });
    </script>
@endif

@if(old('tempinceptiondate'))
<script type="text/javascript">
    $(document).ready(function() {
        $('.datePickerTomorrowPrepopulate').datetimepicker({
            minDate: moment(new Date()).add(1, 'days').startOf('day'),
<<<<<<< HEAD
            maxDate: moment(new Date()).add(1, 'months').startOf('day'),
=======
>>>>>>> test
            allowInputToggle:true,
            ignoreReadonly:true,
            format: 'DD/MM/YYYY',
            useCurrent: false
        });
    });
</script>
@else
<script type="text/javascript">
    $(document).ready(function() {
        $('.datePickerTomorrowPrepopulate').datetimepicker({
            minDate: moment(new Date()).add(1, 'days').startOf('day'),
<<<<<<< HEAD
            maxDate: moment(new Date()).add(1, 'months').startOf('day'),
=======
>>>>>>> test
            allowInputToggle:true,
            ignoreReadonly:true,
            format: 'DD/MM/YYYY'
        });
    });
</script>
@endif

@endsection
