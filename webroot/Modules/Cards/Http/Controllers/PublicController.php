<?php

namespace TypiCMS\Modules\Cards\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Cards\Repositories\CardInterface;

class PublicController extends BasePublicController
{
    public function __construct(CardInterface $card)
    {
        parent::__construct($card);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('cards::public.index')
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

        return view('cards::public.show')
            ->with(compact('model'));
    }
}
