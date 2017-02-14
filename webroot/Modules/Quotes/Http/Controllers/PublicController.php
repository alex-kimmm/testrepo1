<?php

namespace TypiCMS\Modules\Quotes\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Quotes\Repositories\QuoteInterface;

class PublicController extends BasePublicController
{
    public function __construct(QuoteInterface $quote)
    {
        parent::__construct($quote);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('quotes::public.index')
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

        return view('quotes::public.show')
            ->with(compact('model'));
    }
}
