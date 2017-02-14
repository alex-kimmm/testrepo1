<?php

namespace TypiCMS\Modules\Insurancepages\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface InsurancepageInterface extends RepositoryInterface {

    /**
     * @param $step
     * @param $categoryId
     * @return mixed
     */
    public function findByStepAndCategory($step, $categoryId);
}
