<?php

namespace TypiCMS\Modules\Pagefailzs\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class PagefailzTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Pagefailzs\Models\Pagefailz', 'pagefailz_id');
    }
}
