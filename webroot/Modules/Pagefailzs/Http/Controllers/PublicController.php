<?php

namespace TypiCMS\Modules\Pagefailzs\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Pagefailzs\Repositories\PagefailzInterface;

class PublicController extends BasePublicController
{
    public function __construct(PagefailzInterface $pagefailz)
    {
        parent::__construct($pagefailz);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('pagefailzs::public.index')
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

        return view('pagefailzs::public.show')
            ->with(compact('model'));
    }
}
