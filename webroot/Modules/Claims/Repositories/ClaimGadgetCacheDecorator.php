<?php

namespace TypiCMS\Modules\Claims\Repositories;

use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class ClaimGadgetCacheDecorator extends CacheAbstractDecorator implements ClaimGadgetInterface {

    public function __construct(ClaimGadgetInterface $repo, CacheInterface $cache) {
        $this->repo = $repo;
        $this->cache = $cache;
    }

}
