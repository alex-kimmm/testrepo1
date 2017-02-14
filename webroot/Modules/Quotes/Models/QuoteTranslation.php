<?php

namespace TypiCMS\Modules\Quotes\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class QuoteTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Quotes\Models\Quote', 'quote_id');
    }
}
