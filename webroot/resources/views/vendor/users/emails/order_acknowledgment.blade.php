@extends('frontend.layouts.email')

@section('subject', 'Order Acknowledgment')

@section('title','Order Acknowledgment')

@section('main')
<p>Hi {{$order->user->first_name}} {{$order->user->last_name}},</p>

<p>Thanks for buying from ZugarZnap. Here are you order details.</p>

<p>Your order number is <strong>{{$order->ref_number}}</strong></p>

<p><strong>Items In Your Order</strong></p>


<table border="1" cellpadding="0" cellspacing="0" width="500" style="font-size: 12pt;">
    <tbody>
        <tr style="background: #F3F3F3">
            <td></td>
            <td><strong>Price each</strong></td>
            <td><strong>Quantity</strong></td>
            <td><strong>Total</strong></td>
        </tr>

<?php $additionalMonthly = 0; ?>

@foreach($order->orderProducts as $orderProduct)
    <tr>
        <td>{{$orderProduct->product->title}}
         @if(!$orderProduct->product->isInsurance())
            ({{ ($orderProduct->color())? $orderProduct->color()->title . ', ' : '' }}{{ ($orderProduct->size())? $orderProduct->size()->title  : '' }})
         @else
            @if( isset(json_decode($orderProduct->options)->is_recurring) && json_decode($orderProduct->options)->is_recurring )
                Initial Payment
            @endif
         @endif
         </td>
        <td>£{{formatPrice( json_decode($orderProduct->options)->price )}}</td>
        <td>{{ $orderProduct->quantity }}</td>
        <td>£{{formatPrice(json_decode( $orderProduct->options)->price * $orderProduct->quantity )}}</td>
    </tr>
@endforeach

@foreach($order->products as $product)
    @if( isset(json_decode($product->pivot->options)->is_recurring) && json_decode($product->pivot->options)->is_recurring )
        <?php $additionalMonthly = json_decode($product->pivot->options)->price_recurring * PAYMENT_RECUR_FINAL; ?>
        <tr>
            <td>Monthly payment</td>
            <td>£{{formatPrice( json_decode($product->pivot->options)->price_recurring )}}</td>
            <td><?php echo PAYMENT_RECUR_FINAL; ?></td>
            <td>£{{formatPrice( $additionalMonthly )}}</td>
        </tr>
    @endif
@endforeach

<tr>
    <td colspan="3"><strong>Total to pay</strong></td>
    <td>£{{formatPrice($order->price + $additionalMonthly)}}</td>
</tr>
</tbody></table>

<?php $options = json_decode($order->options); ?>

@if( count($options) > 0 )
<p style="font-size: 11pt;text-align: right"><i>All prices include IPT, GST and VAT where applicable.</i></p>
<p><strong>Delivery Address</strong></p>
<p>{{$options->deliveryFirstName or ''}} {{$options->deliveryLastName or ''}}<br>
{{$options->deliveryAddress1 or ''}}<br>
{{$options->deliveryCity or ''}}<br>
{{$options->deliveryPostcode or ''}}</p>
@endif

@endsection
