<?php

namespace TypiCMS\Modules\Musiccards\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Musiccards\Repositories\MusiccardInterface;

class PublicController extends BasePublicController
{
    public function __construct(MusiccardInterface $musiccard)
    {
        parent::__construct($musiccard);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('musiccards::public.index')
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

        return view('musiccards::public.show')
            ->with(compact('model'));
    }
}
