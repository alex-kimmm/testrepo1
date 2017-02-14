<?php

namespace TypiCMS\Modules\Musiccards\Repositories;

use App\Repositories\RepositoryTypiCMSGeneral;
use Illuminate\Database\Eloquent\Model;

class EloquentMusiccard extends RepositoryTypiCMSGeneral implements MusiccardInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

}
