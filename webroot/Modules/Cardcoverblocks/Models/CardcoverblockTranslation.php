<?php

namespace TypiCMS\Modules\Cardcoverblocks\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class CardcoverblockTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Cardcoverblocks\Models\Cardcoverblock', 'cardcoverblock_id');
    }
}
