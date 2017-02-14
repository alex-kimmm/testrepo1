<?php
namespace TypiCMS\Modules\Insurancelandings\Models;

use TypiCMS\Modules\Core\Models\Base;

class InsurancelandingCoverCard extends Base {

    protected $table = 'insurancelandings_cardcoverblocks';

    protected $fillable = [
        'insurancelanding_id',
        'cardcoverblock_id',
        'insurancelandings_cardcoverblock_type',
        'position'
    ];

}
