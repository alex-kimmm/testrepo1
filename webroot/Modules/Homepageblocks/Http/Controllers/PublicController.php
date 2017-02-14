<?php

namespace TypiCMS\Modules\Homepageblocks\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Homepageblocks\Repositories\HomepageblockInterface;

class PublicController extends BasePublicController
{
    public function __construct(HomepageblockInterface $homepageblock)
    {
        parent::__construct($homepageblock);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('homepageblocks::public.index')
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

        return view('homepageblocks::public.show')
            ->with(compact('model'));
    }
}
