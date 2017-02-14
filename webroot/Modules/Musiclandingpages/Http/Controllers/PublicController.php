<?php

namespace TypiCMS\Modules\Musiclandingpages\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Musiclandingpages\Repositories\MusiclandingpageInterface;

class PublicController extends BasePublicController
{
    public function __construct(MusiclandingpageInterface $musiclandingpage)
    {
        parent::__construct($musiclandingpage);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('musiclandingpages::public.index')
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

        return view('musiclandingpages::public.show')
            ->with(compact('model'));
    }
}
