<?php
namespace TypiCMS\Modules\Musiclandingpages\Models;

use TypiCMS\Modules\Core\Models\Base;

class MusiclandingpageHomepageblock extends Base {

    protected $table = 'musiclandingpages_homepageblocks';

    protected $fillable = [
        'musiclandingpage_id',
        'homepageblock_id',
        'musiclandingpages_homepageblock_type',
        'position'
    ];
}
