<?php

namespace TypiCMS\Modules\Headerblocks\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentHeaderblock extends RepositoriesAbstract implements HeaderblockInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAllHeaderBlockFormatted(){
        $headerBlocksAll = $this->all();
        $headerBlocks = [];
        foreach($headerBlocksAll as $headerBlock){
            $headerBlocks[$headerBlock->id] = $headerBlock->title;
        }
        return $headerBlocks;
    }
}
