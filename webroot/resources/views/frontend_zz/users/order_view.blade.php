@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.My Orders') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

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

<div class="row blue-background">

        @include('frontend_zz.inc._nav_account')

        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
            <div class="account-tab-container">
                <div class="account-tab orders">
                    <h3>Order id: {{ $order->id}} <br>  Ref. Number: {{ $order->ref_number != null ? $order->ref_number : '--' }}</h3>
                    @include('frontend_zz.users.order_item_view', [ 'order' => $order ])
                </div>
            </div>
        </div>

    </div>


@endsection