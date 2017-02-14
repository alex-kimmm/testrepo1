<?php

namespace TypiCMS\Modules\Claims\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentClaimGadget extends RepositoriesAbstract implements ClaimGadgetInterface {

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function create(array $data){
        // Create the model
        $model = $this->model->fill($data);

        if ($model->save()) {
            return $model;
        }

        return null;
    }

    public function claimGadgetsGroupBy($groupBy) {
        return $this->model->all()->groupBy($groupBy);
    }
}
