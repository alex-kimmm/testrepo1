<?php

namespace TypiCMS\Modules\Homepageblocks\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface HomepageblockInterface extends RepositoryInterface {

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function findBy($fieldName, $value);

    /**
     * @param array $ids
     * @return mixed
     */
    public function allByIds(array $ids);
}
