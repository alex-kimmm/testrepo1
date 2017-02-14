<?php

namespace TypiCMS\Modules\Musiclandingpages\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface MusiclandingpageCardInterface extends RepositoryInterface {
    /**
     * @return mixed
     */
    public function getAll();

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
