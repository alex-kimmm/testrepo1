<?php

namespace TypiCMS\Modules\Cardcoverblocks\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentCardcoverblock extends RepositoriesAbstract implements CardcoverblockInterface {

    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function allByIds(array $ids) {
        return $this->model->whereIn('id', $ids)->get();
    }
}
