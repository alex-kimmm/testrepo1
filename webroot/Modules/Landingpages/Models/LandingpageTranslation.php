<?php

namespace TypiCMS\Modules\Landingpages\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class LandingpageTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Landingpages\Models\Landingpage', 'landingpage_id');
    }
}
