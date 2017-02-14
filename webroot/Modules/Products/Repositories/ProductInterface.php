<?php

namespace TypiCMS\Modules\Products\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface ProductInterface extends RepositoryInterface {

    /**
     * @param $count
     * @param $category
     * @param $product
     * @return mixed
     */
    public function lastXProductsByCategoryWithOutConcreteProduct($count, $category, $product);

    public function findByCategoriesIds(array $categoriesIds);
}
