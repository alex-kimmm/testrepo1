<?php
namespace TypiCMS\Modules\Landingpages\Repositories;

use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class LandingpageCardCacheDecorator extends CacheAbstractDecorator implements LandingpageCardInterface {
    public function __construct(LandingpageCardInterface $repo, CacheInterface $cache) {
        $this->repo = $repo;
        $this->cache = $cache;
    }
}
