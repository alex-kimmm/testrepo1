<?php

namespace TypiCMS\Modules\Musiclandingpages\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class MusiclandingpageTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Musiclandingpages\Models\Musiclandingpage', 'musiclandingpage_id');
    }
}
