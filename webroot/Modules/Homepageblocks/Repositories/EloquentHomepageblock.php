<?php

namespace TypiCMS\Modules\Homepageblocks\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentHomepageblock extends RepositoriesAbstract implements HomepageblockInterface {

    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function findBy($fieldName, $value) {
        return $this->model->where($fieldName, $value)->first();
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function allByIds(array $ids) {
        return $this->model->whereIn('id', $ids)->get();
    }
}
