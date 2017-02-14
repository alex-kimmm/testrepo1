<?php

namespace TypiCMS\Modules\Landingpages\Models;

use TypiCMS\Modules\Core\Models\Base;

class LandingpageHomepageblock extends Base {

    protected $table = 'landingpages_homepageblocks';

    protected $fillable = [
        'landingpage_id',
        'homepageblock_id',
        'landingpages_homepageblock_type',
        'position'
    ];

}
