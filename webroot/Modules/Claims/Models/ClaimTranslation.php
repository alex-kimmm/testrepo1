<?php

namespace TypiCMS\Modules\Claims\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class ClaimTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Claims\Models\Claim', 'claim_id');
    }
}
