<?php

namespace TypiCMS\Modules\Insurancelandings\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface InsurancelandingHomepageblockInterface extends RepositoryInterface {

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function findBy($fieldName, $value);

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function getAllBy($fieldName, $value);

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function deleteBy($fieldName, $value);
}
