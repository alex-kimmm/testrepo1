<?php

namespace TypiCMS\Modules\Faceofzzlandings\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Faceofzzlandings\Repositories\FaceofzzlandingInterface;

class PublicController extends BasePublicController
{
    public function __construct(FaceofzzlandingInterface $faceofzzlanding)
    {
        parent::__construct($faceofzzlanding);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('faceofzzlandings::public.index')
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

        return view('faceofzzlandings::public.show')
            ->with(compact('model'));
    }
}
