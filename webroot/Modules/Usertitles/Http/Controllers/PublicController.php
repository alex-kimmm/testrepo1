<?php

namespace TypiCMS\Modules\Usertitles\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Usertitles\Repositories\UsertitleInterface;

class PublicController extends BasePublicController
{
    public function __construct(UsertitleInterface $usertitle)
    {
        parent::__construct($usertitle);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('usertitles::public.index')
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

        return view('usertitles::public.show')
            ->with(compact('model'));
    }
}
