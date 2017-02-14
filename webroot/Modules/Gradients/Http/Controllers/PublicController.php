<?php

namespace TypiCMS\Modules\Gradients\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Gradients\Repositories\GradientInterface;

class PublicController extends BasePublicController
{
    public function __construct(GradientInterface $gradient)
    {
        parent::__construct($gradient);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('gradients::public.index')
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

        return view('gradients::public.show')
            ->with(compact('model'));
    }
}
