<?php

namespace TypiCMS\Modules\Orders\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;
use TypiCMS\Modules\Orders\Models\Order;

class EloquentOrder extends RepositoriesAbstract implements OrderInterface {

    public function __construct(Order $model) {
        $this->model = $model;
    }

    /**
     * Create a new model.
     *
     * @param array $data
     *
     * @return mixed Model or false on error during save
     */
    public function create(array $data)
    {
        // Create the model
        $model = $this->model->fill($data);

        if ($model->save()) {
            $this->syncRelation($model, $data, 'products');

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
    public function update(array $data)
    {
        $model = $this->model->find($data['id']);

        $model->fill($data);

        $this->syncRelation($model, $data, 'products');

        if ($model->save()) {
            return true;
        }

        return false;
    }
}
