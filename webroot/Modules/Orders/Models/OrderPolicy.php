<?php

namespace TypiCMS\Modules\Orders\Models;

use TypiCMS\Modules\Core\Models\Base;

class OrderPolicy extends Base {
    protected $table = 'order_policies';

    protected $fillable = [
        'order_id',
        'policy_id',
    ];

    public function order() {
        return $this->belongsTo('TypiCMS\Modules\Orders\Models\Order', 'order_id');
    }
}