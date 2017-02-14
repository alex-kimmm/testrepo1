<?php

namespace TypiCMS\Modules\Homepageblocks\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class HomepageblockTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Homepageblocks\Models\Homepageblock', 'homepageblock_id');
    }
}
