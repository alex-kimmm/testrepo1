<?php

namespace TypiCMS\Modules\Gradients\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class GradientTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Gradients\Models\Gradient', 'gradient_id');
    }
}
