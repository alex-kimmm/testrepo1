@extends('frontend.layouts.app')

@section('title', trans('users::global.My Orders') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')

@if(Session::has('success'))
<script>
    $(document).ready(function(){
        showNotification("{{ Session::get('success') }}", "body", "success", "top", "right", "auto", null, true);
    });
</script>
@endif

@if(Session::has('fail'))
<script>
    $(document).ready(function(){
        showNotification("{{ Session::get('fail') }}", "body", "danger", "top", "right", "auto", null, true);
    });
</script>
@endif

@if(isset($errors) && count($errors) > 0)
    @include('frontend.responses.errors', [ 'errors' => $errors ])
@endif

<div class="row">

        @include('frontend.inc._nav_account')

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="account-tab-container">
                <div class="account-tab orders">
                    <h3>Order id: {{ $order->id}} <br>  Ref. Number: {{ $order->ref_number != null ? $order->ref_number : '--' }}</h3>
                    @include('frontend.users.order_item_view', [ 'order' => $order ])
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">
            <div class="cards green-card gradient-card-size"></div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">
            <div class="cards purple-card gradient-card-size"></div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">
            <div class="cards cyan-card gradient-card-size"></div>
        </div>
    </div>


@endsection