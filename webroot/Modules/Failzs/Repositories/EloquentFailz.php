<?php

namespace TypiCMS\Modules\Failzs\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentFailz extends RepositoriesAbstract implements FailzInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
