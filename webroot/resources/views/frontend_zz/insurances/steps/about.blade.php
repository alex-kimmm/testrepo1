@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Insurance') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<div class="insurance-about">
    @include('frontend_zz.insurances.inc.header_block', [ 'step' => 1, 'insurancePage' => $insurancePageAbout ])

    <section class="all-benefits insurance-all-benefits">
        <a id="b2"></a>
        <div class="container container-1024">
            <div class="benefits-content padding-bottom-10px">
            @forelse($insurancePageAbout->insuranceBlocks as $insuranceBlock)
                @include('frontend_zz.insurances.inc._block', [ 'insuranceBlock' => $insuranceBlock ])
            @empty
            @endforelse
            </div>
        </div>
    </section>

    @include('frontend_zz.inc._financial-services')

    {{--@if(count($insurancePageAbout->cards) > 0)--}}
    {{--@include('frontend_zz.inc.cards._stuff-cards-desktop', [ 'stuffCards' => $insurancePageAbout->cards ])--}}
    {{--@include('frontend_zz.inc.cards._stuff-cards-mobile',  [ 'stuffCards' => $insurancePageAbout->cards ])--}}
    {{--@endif--}}
</div>

@endsection