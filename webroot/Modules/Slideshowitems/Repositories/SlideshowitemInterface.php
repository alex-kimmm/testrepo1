<?php

namespace TypiCMS\Modules\Slideshowitems\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface SlideshowitemInterface extends RepositoryInterface
{
    public function getUrl($item);
}
