<?php

namespace TypiCMS\Modules\Usertitles\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class UsertitleTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Usertitles\Models\Usertitle', 'usertitle_id');
    }
}
