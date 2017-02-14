<?php

namespace TypiCMS\Modules\Failzs\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class FailzTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Failzs\Models\Failz', 'failz_id');
    }
}
