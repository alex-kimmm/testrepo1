<?php

namespace TypiCMS\Modules\Landingpages\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Landingpages\Repositories\LandingpageInterface;

class PublicController extends BasePublicController
{
    public function __construct(LandingpageInterface $landingpage)
    {
        parent::__construct($landingpage);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('landingpages::public.index')
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

        return view('landingpages::public.show')
            ->with(compact('model'));
    }
}
