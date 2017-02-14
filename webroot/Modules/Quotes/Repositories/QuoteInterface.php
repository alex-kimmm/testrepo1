<?php

namespace TypiCMS\Modules\Quotes\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface QuoteInterface extends RepositoryInterface
{
    public function getFirstByUri($uri, $locale = null, array $with = []);
}
