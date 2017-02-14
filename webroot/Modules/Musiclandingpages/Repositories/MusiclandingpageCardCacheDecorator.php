<?php
namespace TypiCMS\Modules\Musiclandingpages\Repositories;

use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class MusiclandingpageCardCacheDecorator extends CacheAbstractDecorator implements MusiclandingpageCardInterface {

    public function __construct(MusiclandingpageInterface $repo, CacheInterface $cache) {
        $this->repo = $repo;
        $this->cache = $cache;
    }
}
