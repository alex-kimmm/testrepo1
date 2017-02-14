<?php
namespace TypiCMS\Modules\Musiclandingpages\Repositories;

use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class MusiclandingpageHomepageblockCacheDecorator extends CacheAbstractDecorator implements MusiclandingpageHomepageblockInterface {

    public function __construct(MusiclandingpageInterface $repo, CacheInterface $cache) {
        $this->repo = $repo;
        $this->cache = $cache;
    }
}
