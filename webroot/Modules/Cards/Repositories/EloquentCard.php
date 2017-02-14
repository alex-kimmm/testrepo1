<?php

namespace TypiCMS\Modules\Cards\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentCard extends RepositoriesAbstract implements CardInterface {

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
