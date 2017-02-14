<?php

namespace TypiCMS\Modules\Slideshowitems\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Slideshowitems\Repositories\SlideshowitemInterface;

class PublicController extends BasePublicController
{
    public function __construct(SlideshowitemInterface $slideshowitem)
    {
        parent::__construct($slideshowitem);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('slideshowitems::public.index')
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

        return view('slideshowitems::public.show')
            ->with(compact('model'));
    }
}
