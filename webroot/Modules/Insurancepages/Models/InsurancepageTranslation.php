<?php

namespace TypiCMS\Modules\Insurancepages\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class InsurancepageTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Insurancepages\Models\Insurancepage', 'insurancepage_id');
    }
}
