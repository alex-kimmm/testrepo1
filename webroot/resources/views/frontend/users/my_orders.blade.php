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
                    <h3>recent orders</h3>

                    @if(count($orders) > 0)
                    <table class="table table-bordered table-condensed table-responsive hidden-sm hidden-xs">
                        <thead>
                        <tr>
                            <th>date</th>
                            <th>Product</th>
                            <th>Initial Payment</th>
                            <th>Total Price</th>
                            <th>payment status</th>
                            <th>ref. number</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr style="cursor: pointer" class="profile-orders-table-delimiter-first" onclick="document.location = '/profile/my-orders/{{$order->id}}';">
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <?php $isGadgetInsurance = false; $isClothing = false; ?>
                                @foreach($order->orderProducts as $i => $orderProduct)
                                    {{ $orderProduct->product->title }}
                                    @if(!$orderProduct->product->isInsurance())
                                        <?php $isClothing = true; ?>
                                        ({{ ($orderProduct->color()) ? $orderProduct->color()->title . ', ' : '' }}{{ ($orderProduct->size()) ? $orderProduct->size()->title : '' }})
                                    @else
                                        <?php $isGadgetInsurance = true; ?>
                                    @endif
                                    <br>
                                @endforeach
                            </td>
                            <td>{{ $order->price != null ? '£' . $order->price : '--' }}</td>
                            <td>{{ $order->price_final != null ? '£' . $order->price_final : '--' }}</td>
                            <td>{{ $order->payment_status != null ? $order->payment_status : '--' }}</td>
                            <td>{{ $order->ref_number != null ? $order->ref_number : '--' }}</td>
                        </tr>
                        <tr class="profile-orders-table-delimiter">
                            <td colspan="6">
                                <div class="text-right">
                                    @if($isClothing)
                                    <a href="/cancel-order" class="btn btn-xs">Cancel order</a>
                                    <a href="/return-order" class="btn btn-xs">Return order</a>
                                    @endif
                                    @if($isGadgetInsurance)
                                        @if($isClothing)|@endif
                                        <a href="/cancel-policy" class="btn btn-xs">Cancel Policy</a>
                                        <a href="/amend-policy" class="btn btn-xs">Amend Policy</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="visible-sm visible-xs">
                    @foreach($orders as $order)
                         <div onclick="document.location = '/profile/my-orders/{{$order->id}}';">
                            @include('frontend.users.order_item_view', [ 'order' => $order ])
                         </div>
                    @endforeach
                    </div>

                    @else
                    <p>There are not orders</p>
                    @endif

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