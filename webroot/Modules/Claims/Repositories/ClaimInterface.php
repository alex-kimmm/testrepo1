<?php

namespace TypiCMS\Modules\Claims\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface ClaimInterface extends RepositoryInterface {

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

}
