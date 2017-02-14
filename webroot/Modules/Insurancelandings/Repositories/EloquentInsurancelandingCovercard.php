<?php

namespace TypiCMS\Modules\Insurancelandings\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentInsurancelandingCovercard extends RepositoriesAbstract implements InsurancelandingCovercardInterface {

    /**
     * @param Model $model
     */
    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll(){
        return $this->model->all();
    }

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function findAllBy($fieldName, $value) {
        return $this->model->where($fieldName, $value)->get();
    }

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function deleteBy($fieldName, $value) {
        $this->model->where($fieldName, $value)->delete();

        return $this->model->where($fieldName, $value)->get() != null ? true : false;
    }
}
