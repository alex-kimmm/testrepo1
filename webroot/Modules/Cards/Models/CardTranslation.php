<?php

namespace TypiCMS\Modules\Cards\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class CardTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Cards\Models\Card', 'card_id');
    }
}
