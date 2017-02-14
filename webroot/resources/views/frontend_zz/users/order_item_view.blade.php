<div class="row profile-orders-table-delimiter order-padding">
    <div class="row">
        <div class="col-sm-6 col-xs-6 order-data-column">Date</div>
        <div class="col-sm-6 col-xs-6">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xs-6 order-data-column">
            {{ (count($order->orderProducts) == 1) ? 'Product' : 'Products' }}
        </div>
        <div class="col-sm-6 col-xs-6 text-uppercase">
            <?php $isInsurance = false; $isClothing = false; ?>
            @foreach($order->orderProducts as $i => $orderProduct)
                <a href="{{ $orderProduct->product->getSeoUrl() }}">
                {{ $orderProduct->product->title }}
                @if($orderProduct->product->category->isClothing())
                    <?php $isClothing = true;?>
                    @if($orderProduct->color() || $orderProduct->size())
                    ({{ ($orderProduct->color()) ? $orderProduct->color()->title . ', ' : '' }}{{ ($orderProduct->size()) ? $orderProduct->size()->title : '' }})
                    @endif
                @elseif($orderProduct->product->category->isInsurance())
                    <?php $isInsurance = true; ?>
                @endif
                </a>
                <br>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xs-6 order-data-column">Value</div>
        <div class="col-sm-6 col-xs-6">{{ $order->price_final != null ? '£' . $order->price_final : '--' }}</div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xs-6 order-data-column">Payment Status</div>
        <div class="col-sm-6 col-xs-6 text-uppercase">{{ $order->payment_status != null ? $order->payment_status : '--' }}</div>
    </div>

    <div class="row profile-orders-table-delimiter-first">
        <div class="col-sm-6 col-xs-6 order-data-column">Ref. Number</div>
        <div class="col-sm-6 col-xs-6">{{ $order->ref_number != null ? $order->ref_number : '--' }}</div>
    </div>

    <div class="row text-uppercase">
        <?php $responsiveClass = (count($order->orderProducts()) > 0) ? ( $isClothing && $isInsurance ? 'col-sm-3 col-xs-6' : 'col-sm-6 col-xs-6') : 'col-sm-12 col-xs-6'; ?>
        {{-- desktop version --}}
        <div class="col-lg-12 col-md-12 hidden-sm hidden-xs">
            <div class="text-right">
                @if($isClothing)
                <a href="/cancel-order" class="btn btn-xs">Cancel order</a>
                <a href="/return-order" class="btn btn-xs">Return order</a>
                @endif
                @if($isInsurance)
                @if($isClothing)|@endif
                <a href="/cancel-policy" class="btn btn-xs">Cancel Policy</a>
                <a href="/amend-policy" class="btn btn-xs">Amend Policy</a>
                @endif
            </div>
        </div>
        {{-- /desktop version --}}

        {{-- mobile version --}}
        <div class="visible-sm visible-xs">
            @if($isClothing)
            <div class="{{ $responsiveClass }}">
                <a href="/cancel-order" class="btn btn-xs">Cancel order</a>
            </div>
            <div class="{{ $responsiveClass }} text-right">
                <a href="/return-order" class="btn btn-xs">Return order</a>
            </div>
            @endif

            @if(count($order->orderProducts) > 0 && $isInsurance)
            <div class="{{ $responsiveClass }}">
                <a href="/cancel-policy" class="btn btn-xs">Cancel Policy</a>
            </div>
            <div class="{{ $responsiveClass }} text-right">
                <a href="/amend-policy" class="btn btn-xs">Amend Policy</a>
            </div>
            @endif
        </div>
        {{-- /mobile version --}}

    </div>
</div>
                        