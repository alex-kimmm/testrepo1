<?php

namespace TypiCMS\Modules\Insurancelandings\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface InsurancelandingCovercardInterface extends RepositoryInterface {

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function findAllBy($fieldName, $value);

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function deleteBy($fieldName, $value);
}
