<?php

namespace App\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface TypiCMSGeneralInterface extends RepositoryInterface
{
    public function allSortedByColumn($column, $asc = true, array $with = [], $all = false);
}
