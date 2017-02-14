<?php

namespace TypiCMS\Modules\Usertitles\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentUsertitle extends RepositoriesAbstract implements UsertitleInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
