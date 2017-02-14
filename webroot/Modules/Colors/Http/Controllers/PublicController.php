<?php

namespace TypiCMS\Modules\Colors\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Colors\Repositories\ColorInterface;

class PublicController extends BasePublicController
{
    public function __construct(ColorInterface $color)
    {
        parent::__construct($color);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('colors::public.index')
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

        return view('colors::public.show')
            ->with(compact('model'));
    }
}
