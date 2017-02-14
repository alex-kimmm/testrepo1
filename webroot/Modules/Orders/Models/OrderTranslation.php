<?php

namespace TypiCMS\Modules\Orders\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class OrderTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Orders\Models\Order', 'order_id');
    }
}
