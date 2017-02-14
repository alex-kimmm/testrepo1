<?php

namespace TypiCMS\Modules\Orders\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Orders\Repositories\OrderInterface;

class PublicController extends BasePublicController
{
    public function __construct(OrderInterface $order)
    {
        parent::__construct($order);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('orders::public.index')
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

        return view('orders::public.show')
            ->with(compact('model'));
    }
}
