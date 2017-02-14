<?php

namespace TypiCMS\Modules\Slideshows\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class SlideshowTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Slideshows\Models\Slideshow', 'slideshow_id');
    }
}
