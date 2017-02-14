<<<<<<< HEAD
<div class="insurance-new-steps">
=======
<div class="insurance-new-steps" style="z-index: 9999; position: fixed; left: 50%; transform: translateX(-50%);">
>>>>>>> test
    <ul class="list-inline active-step-{{$step}}">
        <li class="step-1 first {{ $step == 1 ? 'active' : '' }}">
            <a href="{{ $insuranceStepLink }}/about">About</a>
            <div class="arrow-img-container">
                <span class="arrow-img"></span>
            </div>
        </li>

        <li class="step-2 {{ $step == 2 ? 'first active' : '' }}">
            <a href="{{ $insuranceStepLink }}/benefits">BENEFITS</a>
            <div class="arrow-img-container">
                <span class="arrow-img"></span>
            </div>
        </li>

        <li class="step-3 {{ $step == 3 ? 'active last' : '' }}" style="padding: 0 0 0 0;">
            <a href="{{ $insuranceStepLink }}/get-cover">GET COVER</a>
        </li>
    </ul>
</div>