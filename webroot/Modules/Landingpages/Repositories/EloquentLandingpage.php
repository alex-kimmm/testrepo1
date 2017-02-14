<?php

namespace TypiCMS\Modules\Landingpages\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentLandingpage extends RepositoriesAbstract implements LandingpageInterface {

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
            $this->syncRelation($model, $data, 'homePageBlocks');
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

        $this->syncRelation($model, $data, 'homePageBlocks');
        $this->syncRelation($model, $data, 'cards');

        if ($model->save()) {
            return true;
        }

        return false;
    }
}
