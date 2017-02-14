<?php

namespace TypiCMS\Modules\Orders\Models;

use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Colors\Models\Color;
use TypiCMS\Modules\Sizes\Models\Size;

class OrderProduct extends Base {
    protected $table = 'order_products';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'options',
        'order_product_type',
        'position'
    ];

    public function order() {
        return $this->belongsTo('TypiCMS\Modules\Orders\Models\Order');
    }

    public function product() {
        return $this->belongsTo('TypiCMS\Modules\Products\Models\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color() {
        try{
            return Color::find(\GuzzleHttp\json_decode($this->options)->color);
        } catch(\Exception $e){
            return null;
        }

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function size() {
        try{
            return Size::find(\GuzzleHttp\json_decode($this->options)->size);
        } catch(\Exception $e){
            return null;
        }
    }
}
