<?php

namespace TypiCMS\Modules\Insurancepages\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentInsurancepage extends RepositoriesAbstract implements InsurancepageInterface {

    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * Create a new model.
     *
     * @param array $data
     *
     * @return mixed Model or false on error during save
     */
    public function create(array $data) {
        // Create the model
        $model = $this->model->fill($data);

        if ($model->save()) {
            $this->syncRelation($model, $data, 'insuranceBlocks');
            $this->syncRelation($model, $data, 'cards');

            return $model;
        }

        return false;
    }

    /**
     * Update an existing model.
     *
     * @param array $data
     *
     * @return bool
     */
    public function update(array $data) {
        $model = $this->model->find($data['id']);

        $model->fill($data);
        if ($model->save()) {
            $this->syncRelation($model, $data, 'insuranceBlocks');
            $this->syncRelation($model, $data, 'cards');

            return true;
        }

        return false;
    }

    /**
     * @param $step
     * @param $categoryId
     * @return mixed
     */
    public function findByStepAndCategory($step, $categoryId) {
        return $this->model->where('step', $step)->where('category_id', $categoryId)->first();
    }
}
