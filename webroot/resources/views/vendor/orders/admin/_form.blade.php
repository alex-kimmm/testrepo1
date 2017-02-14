@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

<h3>Order info</h3>

<table class="details-table">
    <tr>
        <td>Order ID:</td>
        <td>{{ $model->id }}</td>
    </tr>
    <tr>
        <td>Transaction ID:</td>
        <td>{{ $model->transaction_id }}</td>
    </tr>
    <tr>
        <td>Status:</td>
        <td><span class="label label-info">{{ $model->payment_status }}</span></td>
    </tr>
    <tr>
        <td>Reference number:</td>
        <td>{{ $model->ref_number }}</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>

    <?php
        $options = json_decode($model->options);

        $deliveryName = isset($options->deliveryFirstName) ? $options->deliveryFirstName : "";
        $deliveryLast = isset($options->deliveryLastName) ? $options->deliveryLastName . "<br>" : "";
        $deliveryEmail = isset($options->deliveryEmail) ? $options->deliveryEmail . "<br>" : "";
        $deliveryPhone = isset($options->deliveryPhone) ? $options->deliveryPhone . "<br>" : "";
        $deliveryCity = isset($options->deliveryCity) ? $options->deliveryCity . "," : "";
        $deliveryPostcode = isset($options->deliveryPostcode) ? $options->deliveryPostcode . "," : "";
        $deliveryAddress1 = isset($options->deliveryAddress1) ? $options->deliveryAddress1 : "";

        $billingName = isset($options->billingFirstName) ? $options->billingFirstName : "";
        $billingLast = isset($options->billingLastName) ? $options->billingLastName . "<br>" : "";
        $billingPhone = isset($options->billingPhone) ? $options->billingPhone . "<br>" : "";
        $billingCity = isset($options->billingCity) ? $options->billingCity . "," : "";
        $billingPostcode = isset($options->billingPostcode) ? $options->billingPostcode . "," : "";
        $billingAddress1 = isset($options->billingAddress1) ? $options->billingAddress1 : "";
    ?>

    <tr>
        <td style="vertical-align: top;">Delivery details:</td>
        <td>
            {{ $deliveryName }} {!! $deliveryLast !!}
            {!! $deliveryEmail !!}
            {!! $deliveryPhone !!}
            {{ $deliveryCity }} {{ $deliveryPostcode }} {{ $deliveryAddress1 }}
        </td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>

    <tr>
        <td style="vertical-align: top;">Billing details:</td>
        <td>
            {{ $billingName }} {!! $billingLast !!}
            {!! $billingPhone !!}
            {{ $billingCity }} {{ $billingPostcode }} {{ $billingAddress1 }}
        </td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>

    @if($model->price == $model->price_final)
    <tr>
        <td>Total price:</td>
        <td>{{ $model->price_final }}</td>
    </tr>
    @else
    <tr>
        <td>Initial payment:</td>
        <td>{{ $model->price }}</td>
    </tr>
    <tr>
        <td>Monthly allowance:</td>
        <td>{{ number_format(( ($model->price_final - $model->price) / 11 ), 2, '.', '') }}</td>
    </tr>
    <tr>
        <td>Total price:</td>
        <td>{{ $model->price_final }}</td>
    </tr>
    @endif
</table>

<hr>

<h3>User info</h3>

<table class="details-table">
    <tr>
        <td>Name:</td>
        <td><a href="/admin/users/{{ $model->user->id }}/edit">{{ $model->user->first_name }} {{ $model->user->last_name }}</a></td>
    </tr>
    <tr>
        <td>Email:</td>
        <td>{{ $model->user->email }}</td>
    </tr>
    <tr>
        <td>Registered at:</td>
        <td>{{ \Carbon\Carbon::parse($model->user->created_at)->format('m/d/Y, H:m')}}</td>
    </tr>
</table>

<hr>

<h3>Products</h3>

@foreach($model->products as $p)

<?php
$options = json_decode($p->pivot->options)
?>

    <div style="border: 1px solid #cccccc; margin: 10px 0; padding: 10px;">
        @if($p->isInsurance())
            Insurance:
        @else
            Clothing:
        @endif
        <a href="/admin/products/{{ $p->id }}/edit">{{ $p->title }}</a><br>
        Price: {{ isset($options->price_final) ? $options->price_final : "" }}<br>
        Quantity: {{ $p->pivot->quantity }}<br>

        @if($options->is_insurance && $options->is_recurring)
            <span class="label label-info">Is recurring payment</span><br>
        @endif

        @if(!$p->isInsurance() && $options->size)
            Size: {{ \TypiCMS\Modules\Sizes\Models\Size::find($options->size)->title }}<br>
        @endif

        @if(!$p->isInsurance() && $options->color)
            Color: {{ \TypiCMS\Modules\Colors\Models\Color::find($options->color)->title }}<br>
        @endif

    </div>
@endforeach
