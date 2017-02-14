@extends('frontend.layouts.app')

@section('title', trans('users::global.Claim Successfully Created') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')

<section class="cards-grid">
    <div class="row">
	    <div class="orange-gradient claims-orange-gradient">
	    	<div class="container">
	    	    <div class="claim-success-info">
                    Thank you for submitting the claim.<br>One of our team members will be in touch soon
                </div>
	    	</div>
	    </div>
	</div>
</section>

@endsection
