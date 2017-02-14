<?php

namespace TypiCMS\Modules\Colors\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class ColorTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Colors\Models\Color', 'color_id');
    }
}
