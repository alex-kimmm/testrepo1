<?php

namespace TypiCMS\Modules\Insurancelandings\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class InsurancelandingTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Insurancelandings\Models\Insurancelanding', 'insurancelanding_id');
    }
}
