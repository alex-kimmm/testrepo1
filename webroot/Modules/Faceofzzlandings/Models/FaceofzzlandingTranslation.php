<?php

namespace TypiCMS\Modules\Faceofzzlandings\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class FaceofzzlandingTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Faceofzzlandings\Models\Faceofzzlanding', 'faceofzzlanding_id');
    }
}
