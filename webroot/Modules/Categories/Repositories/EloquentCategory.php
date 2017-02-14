<?php

namespace TypiCMS\Modules\Categories\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentCategory extends RepositoriesAbstract implements CategoryInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
