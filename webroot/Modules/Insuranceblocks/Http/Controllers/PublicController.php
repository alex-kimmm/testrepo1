<?php

namespace TypiCMS\Modules\Insuranceblocks\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Insuranceblocks\Repositories\InsuranceblockInterface;

class PublicController extends BasePublicController
{
    public function __construct(InsuranceblockInterface $insuranceblock)
    {
        parent::__construct($insuranceblock);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('insuranceblocks::public.index')
            ->with(compact('models'));
    }

    /**
     * Show news.
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $model = $this->repository->bySlug($slug);

        return view('insuranceblocks::public.show')
            ->with(compact('model'));
    }
}
