<?php

namespace TypiCMS\Modules\Claims\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Claims\Repositories\ClaimInterface;

class PublicController extends BasePublicController
{
    public function __construct(ClaimInterface $claim)
    {
        parent::__construct($claim);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('claims::public.index')
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

        return view('claims::public.show')
            ->with(compact('model'));
    }
}
