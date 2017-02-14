<?php

namespace TypiCMS\Modules\Cardcoverblocks\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface CardcoverblockInterface extends RepositoryInterface {

    /**
     * @param array $ids
     * @return mixed
     */
    public function allByIds(array $ids);
}
