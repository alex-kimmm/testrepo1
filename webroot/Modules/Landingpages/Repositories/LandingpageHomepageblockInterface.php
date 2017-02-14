<?php
namespace TypiCMS\Modules\Landingpages\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoryInterface;

interface LandingpageHomepageblockInterface extends RepositoryInterface {

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function getAllBy($fieldName, $value);

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function deleteBy($fieldName, $value);
}
