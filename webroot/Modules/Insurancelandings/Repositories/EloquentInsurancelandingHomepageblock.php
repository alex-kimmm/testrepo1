<?php

namespace TypiCMS\Modules\Insurancelandings\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentInsurancelandingHomepageblock extends RepositoriesAbstract implements InsurancelandingHomepageblockInterface {

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
    public function findBy($fieldName, $value) {
        return $this->model->where($fieldName, $value)->first();
    }

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function getAllBy($fieldName, $value) {
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
