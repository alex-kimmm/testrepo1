<?php

namespace TypiCMS\Modules\Sizes\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentSize extends RepositoriesAbstract implements SizeInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
