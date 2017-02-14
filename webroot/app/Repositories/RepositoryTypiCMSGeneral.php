<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class RepositoryTypiCMSGeneral extends RepositoriesAbstract implements TypiCMSGeneralInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all models.
     *
     * @param array $with Eager load related models
     * @param bool  $all  Show published or all
     *
     * @return Collection|NestedCollection
     */
    public function allSortedByColumn($column, $asc = true, array $with = [], $all = false)
    {
        $query = $this->make($with);

        if (!$all) {
            $query->online();
        }

        // Query ORDER BY
        $query->orderBy($column, $asc? 'asc' : 'desc');

        // Get
        return $query->get();
    }

}
