<?php
namespace TypiCMS\Modules\Insurancelandings\Models;

use TypiCMS\Modules\Core\Models\Base;

class InsurancelandingCard extends Base {

    protected $table = 'insurancelandings_cards';

    protected $fillable = [
        'insurancelanding_id',
        'card_id',
        'insurancelandings_card_type',
        'position'
    ];

}
