
<form action="{{ $action }}" class="form-horizontal" role="form" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="order_id" value="{{ $order_id }}"/>
    <input type="hidden" name="product_id" value="{{ $product_id }}"/>

    <div class="row">
        <div class="col-md-2">
            <label>Make a claim</label>
        </div>
        <div class="col-md-6">
            <textarea name="description" rows="3" style="width: 200px;"></textarea>
        </div>
    </div>
    <div class="form-group form-action">
        <button type="submit" class="btn-primary">Post</button>
    </div>
</form>