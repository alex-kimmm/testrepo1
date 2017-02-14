<?php

namespace TypiCMS\Modules\Colors\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentColor extends RepositoriesAbstract implements ColorInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
