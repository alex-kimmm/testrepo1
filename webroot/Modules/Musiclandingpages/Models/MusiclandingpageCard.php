<?php
namespace TypiCMS\Modules\Musiclandingpages\Models;

use TypiCMS\Modules\Core\Models\Base;

class MusiclandingpageCard extends Base {

    protected $table = 'musiclandingpages_cards';

    protected $fillable = [
        'musiclandingpage_id',
        'card_id',
        'musiclandingpages_card_type',
        'position'
    ];
}
