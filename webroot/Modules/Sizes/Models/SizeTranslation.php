<?php

namespace TypiCMS\Modules\Sizes\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class SizeTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Sizes\Models\Size', 'size_id');
    }
}
