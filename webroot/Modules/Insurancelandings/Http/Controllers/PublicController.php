<?php

namespace TypiCMS\Modules\Insurancelandings\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Insurancelandings\Repositories\InsurancelandingInterface;

class PublicController extends BasePublicController
{
    public function __construct(InsurancelandingInterface $insurancelanding)
    {
        parent::__construct($insurancelanding);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('insurancelandings::public.index')
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

        return view('insurancelandings::public.show')
            ->with(compact('model'));
    }
}
