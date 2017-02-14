<?php

namespace TypiCMS\Modules\Slideshows\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Slideshows\Repositories\SlideshowInterface;

class PublicController extends BasePublicController
{
    public function __construct(SlideshowInterface $slideshow)
    {
        parent::__construct($slideshow);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('slideshows::public.index')
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

        return view('slideshows::public.show')
            ->with(compact('model'));
    }
}
