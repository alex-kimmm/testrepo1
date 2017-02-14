<?php
namespace TypiCMS\Modules\Insurancelandings\Models;

use TypiCMS\Modules\Core\Models\Base;

class InsurancelandingHomepageblock extends Base {

    protected $table = 'insurancelandings_homepageblocks';

    protected $fillable = [
        'insurancelanding_id',
        'homepageblock_id',
        'insurancelandings_homepageblock_type',
        'position'
    ];

}
