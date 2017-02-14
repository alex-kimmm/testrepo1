<?php

namespace TypiCMS\Modules\Orders\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;
use TypiCMS\Modules\Orders\Models\OrderPolicy;


class EloquentOrderPolicy extends RepositoriesAbstract implements OrderPolicyInterface
{
    public function __construct(OrderPolicy $model)
    {
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
        $model = $this->model->insert($data);
        return $model;
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

        $this->syncRelation($model, $data);

        if ($model->save()) {
            return true;
        }

        return false;
    }
}
