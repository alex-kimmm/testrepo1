<?php

namespace TypiCMS\Modules\Insurancepages\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Insurancepages\Repositories\InsurancepageInterface;

class PublicController extends BasePublicController
{
    public function __construct(InsurancepageInterface $insurancepage)
    {
        parent::__construct($insurancepage);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('insurancepages::public.index')
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

        return view('insurancepages::public.show')
            ->with(compact('model'));
    }
}
