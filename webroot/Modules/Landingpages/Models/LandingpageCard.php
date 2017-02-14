<?php

namespace TypiCMS\Modules\Landingpages\Models;

use TypiCMS\Modules\Core\Models\Base;

class LandingpageCard extends Base {

    protected $table = 'landingpages_cards';

    protected $fillable = [
        'landingpage_id',
        'card_id',
        'landingpages_card_type',
        'position'
    ];

}
