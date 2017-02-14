@extends('frontend.layouts.app')

@section('title', trans('users::global.Insurance') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')

<script type='text/javascript'>
    var optionsPrice = <?php echo \GuzzleHttp\json_encode($optionsPrice,true);?>;
</script>

<div id="insuranceSwipe" class="swipe">
    <div class="swipe-wrap">
        <div class="step-1">
            @if($step == 1)
            @include('frontend.insurances.inc.step_1', ['insurance_page' => $insurance_page])
            @endif
        </div>
        <div class="step-2">
            @if($step == 2)
            @include('frontend.insurances.inc.step_2', ['insurance_page' => $insurance_page])
            @endif
        </div>
        <div class="step-3">
            @if($step == 3)
            @include('frontend.insurances.inc.step_3', ['insurance_page' => $insurance_page])
            @endif
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
    InsuranceUrlBuilder.init();

    $(document).ready(function() {

        var insurance_id = {{ $product->id }};
        var steps = <?php echo json_encode($empty_steps) ?>;

        InsuranceDataBuilder.init(insurance_id, steps, 'step');
        InsuranceSectionAnimation.sectionHeight('step-' + InsuranceUrlBuilder.getPosition());
        InsuranceSectionAnimation.init();

        InsuranceSectionAnimation.initStickyWithIndex(InsuranceUrlBuilder.getPosition() - 1);

        InsuranceDataBuilder.updateSomeViews();
    });

    InsuranceDataBuilder.initForm();
</script>

@endsection
