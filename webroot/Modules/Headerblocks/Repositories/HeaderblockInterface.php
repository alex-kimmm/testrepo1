<?php

namespace TypiCMS\Modules\Headerblocks\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface HeaderblockInterface extends RepositoryInterface
{
    public function getAllHeaderBlockFormatted();
}
