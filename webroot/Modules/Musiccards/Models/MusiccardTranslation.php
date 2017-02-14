<?php

namespace TypiCMS\Modules\Musiccards\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class MusiccardTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Musiccards\Models\Musiccard', 'musiccard_id');
    }
}
