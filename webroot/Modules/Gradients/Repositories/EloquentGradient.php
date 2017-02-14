<?php

namespace TypiCMS\Modules\Gradients\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentGradient extends RepositoriesAbstract implements GradientInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
