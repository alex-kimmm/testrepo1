<?php
namespace TypiCMS\Modules\Landingpages\Repositories;

use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class LandingpageHomepageblockCacheDecorator extends CacheAbstractDecorator implements LandingpageHomepageblockInterface {
    public function __construct(LandingpageHomepageblockInterface $repo, CacheInterface $cache) {
        $this->repo = $repo;
        $this->cache = $cache;
    }
}
