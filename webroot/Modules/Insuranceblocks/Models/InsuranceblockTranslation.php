<?php

namespace TypiCMS\Modules\Insuranceblocks\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class InsuranceblockTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Insuranceblocks\Models\Insuranceblock', 'insuranceblock_id');
    }
}
