<!-- Floating buttons -->
<?php
$items = [
    1 =>['percentage' =>30, 'title' => 'gadget'],
    2 => ['percentage' =>64, 'title' => 'benefits'],
    3 => ['percentage' =>100, 'title' => 'get cover'],
];
?>
<div class="row" id="main-steps">
    <div id="insurance-steps-{{$current_step}}" class="insurance-steps">
        <div class="_step_{{$current_step}}">
            <div class="row insurance-progress progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="{{$items[$current_step]['percentage']}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$items[$current_step]['percentage']}}%;"></div>
            </div>
            <div class="insurance-buttons">
                @foreach($items as $step_key => $step_info)
                     @if($step_key==$current_step)
                        <button class="btn current">{{$step_key}}. {{$step_info['title']}}</button>
                     @else
                        <button class="btn" onclick="InsuranceSwipeHandler.toPos(insuranceSwipe, 'step', {{($step_key-1)}})">{{$step_key}}. {{$step_info['title']}}</button>
                     @endif
                @endforeach
            </div>
        </div>

    </div>
</div>
<!-- End Floating buttons -->