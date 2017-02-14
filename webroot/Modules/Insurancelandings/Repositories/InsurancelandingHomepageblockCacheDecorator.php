<?php

namespace TypiCMS\Modules\Insurancelandings\Repositories;

use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class InsurancelandingHomepageblockCacheDecorator extends CacheAbstractDecorator implements InsurancelandingHomepageblockInterface {
    public function __construct(InsurancelandingHomepageblockInterface $repo, CacheInterface $cache) {
        $this->repo = $repo;
        $this->cache = $cache;
    }
}
