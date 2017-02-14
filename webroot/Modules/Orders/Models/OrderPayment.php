<?php

namespace TypiCMS\Modules\Orders\Models;

use TypiCMS\Modules\Core\Models\Base;

class OrderPayment extends Base
{
    protected $table = 'order_payments';

    protected $fillable = [
        'payment',
        'order_id',
        'success'
    ];

    public function order() {
        return $this->belongsTo('TypiCMS\Modules\Orders\Models\Order');
    }
}
