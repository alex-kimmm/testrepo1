<?php

namespace TypiCMS\Modules\Slideshowitems\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentSlideshowitem extends RepositoriesAbstract implements SlideshowitemInterface
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
        return env('SLIDESHOWITEM_VIDEO_UPLOAD_PATH')  . $item;
    }
}
