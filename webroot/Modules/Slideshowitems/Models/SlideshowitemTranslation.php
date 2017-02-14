<?php

namespace TypiCMS\Modules\Slideshowitems\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class SlideshowitemTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Slideshowitems\Models\Slideshowitem', 'slideshowitem_id');
    }
}
