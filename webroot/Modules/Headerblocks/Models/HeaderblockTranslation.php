<?php

namespace TypiCMS\Modules\Headerblocks\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class HeaderblockTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Headerblocks\Models\Headerblock', 'headerblock_id');
    }
}
