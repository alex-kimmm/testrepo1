<?php

namespace TypiCMS\Modules\Insuranceblocks\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentInsuranceblock extends RepositoriesAbstract implements InsuranceblockInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param $productDirName
     * @param $imageSrc
     * @return string
     */
    public function getUrl($item) {
        return env('INSURANCE_BLOCKS_IMAGE_VIDEO_UPLOAD_PATH')  . $item;
    }
}
