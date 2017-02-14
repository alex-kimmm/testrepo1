<?php

namespace TypiCMS\Modules\Failzs\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Failzs\Repositories\FailzInterface;

class PublicController extends BasePublicController
{
    public function __construct(FailzInterface $failz)
    {
        parent::__construct($failz);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('failzs::public.index')
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

        return view('failzs::public.show')
            ->with(compact('model'));
    }
}
