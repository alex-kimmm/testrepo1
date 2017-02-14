<?php

namespace TypiCMS\Modules\Sizes\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Sizes\Repositories\SizeInterface;

class PublicController extends BasePublicController
{
    public function __construct(SizeInterface $size)
    {
        parent::__construct($size);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('sizes::public.index')
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

        return view('sizes::public.show')
            ->with(compact('model'));
    }
}
