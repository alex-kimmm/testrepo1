<?php

namespace TypiCMS\Modules\Claims\Models;

use TypiCMS\Modules\Core\Models\Base;

class ClaimGadget extends Base {

    protected $table = 'claim_gadgets';

    protected $fillable = [
        'category',
        'bran',
        'model',
        'version'
    ];

}
