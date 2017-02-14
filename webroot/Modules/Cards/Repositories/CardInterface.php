<?php

namespace TypiCMS\Modules\Cards\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface CardInterface extends RepositoryInterface {

    /**
     * @param array $ids
     * @return mixed
     */
    public function allByIds(array $ids);
}
