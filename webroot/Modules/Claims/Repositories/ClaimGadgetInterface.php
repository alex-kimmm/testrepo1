<?php

namespace TypiCMS\Modules\Claims\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface ClaimGadgetInterface extends RepositoryInterface {

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $groupBy
     * @return mixed
     */
    public function claimGadgetsGroupBy($groupBy);

}
