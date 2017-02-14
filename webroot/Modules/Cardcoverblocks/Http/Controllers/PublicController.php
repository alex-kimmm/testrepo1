<?php

namespace TypiCMS\Modules\Cardcoverblocks\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Cardcoverblocks\Repositories\CardcoverblockInterface;

class PublicController extends BasePublicController
{
    public function __construct(CardcoverblockInterface $cardcoverblock)
    {
        parent::__construct($cardcoverblock);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('cardcoverblocks::public.index')
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

        return view('cardcoverblocks::public.show')
            ->with(compact('model'));
    }
}
