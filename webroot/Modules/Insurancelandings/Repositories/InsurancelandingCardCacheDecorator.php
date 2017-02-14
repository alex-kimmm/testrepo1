<?php

namespace TypiCMS\Modules\Insurancelandings\Repositories;

use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class InsurancelandingCardCacheDecorator extends CacheAbstractDecorator implements InsurancelandingCardInterface {
    public function __construct(InsurancelandingCardInterface $repo, CacheInterface $cache) {
        $this->repo = $repo;
        $this->cache = $cache;
    }
}
