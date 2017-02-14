<?php

namespace TypiCMS\Modules\Musiclandingpages\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentMusiclandingpage extends RepositoriesAbstract implements MusiclandingpageInterface {

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
            $this->syncRelation($model, $data, 'cardCoverBlocks');

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
            $this->syncRelation($model, $data, 'homePageBlocks');
            $this->syncRelation($model, $data, 'cards');
            $this->syncRelation($model, $data, 'cardCoverBlocks');

            return true;
        }

        return false;
    }
}
