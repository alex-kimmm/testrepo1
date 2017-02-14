<section class="getme-covered">
    <div class="container container-1024">
<<<<<<< HEAD
        <h2>Get a quote!</h2>
=======
        <h2>Get me Covered!</h2>
>>>>>>> test
        {!! BootForm::open()->action( route('insurance.postprecompleteinsurance') )->post()->id("make-claim-form")->attribute('novalidate','novalidate') !!}
        <div id="getMeCoveredSelects" class="row getme-covered-selects">
            <div class="col-md-1 col-sm-1"></div>
            <div class="col-md-3 col-sm-3">
                <p>Cover my...</p>

                <?php $selectedProductCoverKey = key($dataInsurances);?>

                @include('frontend_zz.inc.blocks._dropdown_select',[
                    'selectName' => 'product_id',
                    'selectItems' => [
                                        $dataInsurances['gadgetCover']->id  => $dataInsurances['gadgetCover']->title,
                                        $dataInsurances['xsCover']->id      => $dataInsurances['xsCover']->title,
                                     ],
                    'selectedItemKey' => $selectedProductCoverKey,
                ])

            </div>
            <div class="col-md-3 col-sm-3">
                <p>For up to...</p>

                @foreach($dataInsurances as $key => $productCover)
                    @include('frontend_zz.inc.blocks._dropdown_select',[
                        'attributeOptions' => [
                            'id' => 'ds_'.$productCover->id,
                            'class' => 'coverPriceOptionSelect' . (($selectedProductCoverKey != $key)? ' hidden ' : ''),
                        ],
                        'selectName' => $productCover->id . '_attributeOptionID',
                        'selectItems' => $productCover->getFormattedPriceOptions(),
                    ])
                @endforeach



            </div>
            <div class="col-md-3 col-sm-3">
                <p>Starting...</p>
<<<<<<< HEAD
                <input readonly type="text" name="date" class="datePickerTomorrow homepage-date-picker">
=======
                <input type="text" name="date" class="datePickerTomorrow homepage-date-picker">
>>>>>>> test
            </div>
            <div class="col-md-1 col-sm-1">
                <button class="btn btn-go" type="button">GO!</button>
            </div>
            <div class="col-md-1 col-sm-1"></div>
        </div>
        {!! BootForm::close() !!}
    </div>
</section>

@section('js')
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('body').on('click','.btn-go',function(){
<<<<<<< HEAD
                try {
                    window.localStorage.setItem('scrollToForm', true);
                 }
                 catch (err) {
                 }
=======
                window.localStorage.setItem('scrollToForm', true);
>>>>>>> test
                $(this).closest('form').submit();
            });
        });
    </script>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> test
