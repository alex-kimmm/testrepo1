<?php

namespace TypiCMS\Modules\Products\Repositories;

use Illuminate\Support\Facades\DB;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class EloquentProduct extends RepositoriesAbstract implements ProductInterface {

    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * Create a new model.
     *
     * @param array $data
     *
     * @return mixed Model or false on error during save
     */
    public function create(array $data) {
        // Create the model
        $model = $this->model->fill($data);

        if ($model->save()) {
            $this->syncRelation($model, $data, 'colors');
            $this->syncRelation($model, $data, 'sizes');

            return $model;
        }

        return false;
    }

    /**
     * Update an existing model.
     *
     * @param array $data
     *
     * @return bool
     */
    public function update(array $data) {
        $model = $this->model->find($data['id']);

        $model->fill($data);

        $this->syncRelation($model, $data, 'colors');
        $this->syncRelation($model, $data, 'sizes');

        if ($model->save()) {
            return true;
        }

        return false;
    }

    /**
     * @param $count
     * @param $category
     * @param $product
     * @return mixed
     */
//    public function lastXProductsByCategoryWithOutConcreteProduct($count, $category, $product) {
//        return $this->model->where('category_id', $category)->where('id', '<>', $product)->orderBy('id', 'DESC')->take($count)->get();
//    }
    public function lastXProductsByCategoryWithOutConcreteProduct($count, $category, $product) {
        return $this->model->online()
            ->where('products.category_id', $category)
            ->where('products.id', '<>', $product)
            ->orderBy('products.id', 'DESC')
            ->take($count)
            ->get();
    }

    public function findByCategoriesIds(array $categoriesIds){
        return $this->model->online()->whereIn('products.category_id', $categoriesIds)->get();
    }
}
