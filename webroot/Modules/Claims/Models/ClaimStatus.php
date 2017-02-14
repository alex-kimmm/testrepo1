<?php

namespace TypiCMS\Modules\Claims\Models;

use TypiCMS\Modules\Core\Models\Base;

class ClaimStatus extends Base {
    protected $table = 'claim_statuses';

    protected $fillable = [
        'name',
    ];

    public function claims() {
        return $this->hasMany('TypiCMS\Modules\Claims\Models\Claim');
    }

}