<?php

namespace TypiCMS\Modules\Insurancelandings\Repositories;

use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class InsurancelandingCovercardCacheDecorator extends CacheAbstractDecorator implements InsurancelandingCovercardInterface {

    public function __construct(InsurancelandingCovercardInterface $repo, CacheInterface $cache) {
        $this->repo = $repo;
        $this->cache = $cache;
    }
}
