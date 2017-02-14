<?php

namespace TypiCMS\Modules\Slideshowitems\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Pages\Repositories\PageInterface;
use TypiCMS\Modules\Products\Repositories\ProductInterface;
use TypiCMS\Modules\Slideshowitems\Http\Requests\FormRequest;
use TypiCMS\Modules\Slideshowitems\Models\Slideshowitem;
use TypiCMS\Modules\Slideshowitems\Repositories\SlideshowitemInterface;

class AdminController extends BaseAdminController
{
    protected $productRepository;
    protected $pageRepository;

    public function __construct(SlideshowitemInterface $slideshowitem, ProductInterface $product, PageInterface $page)
    {
        parent::__construct($slideshowitem);
        $this->productRepository = $product;
        $this->pageRepository = $page;
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();
        $products = $this->productRepository->getModel()->all()->pluck('title', 'id')->all();
        $pages = $this->pageRepository->getModel()->all()->pluck('title', 'id')->all();

        return view('core::admin.create')
            ->with(compact('model','products','pages'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Slideshowitems\Models\Slideshowitem $slideshowitem
     *
     * @return \Illuminate\View\View
     */
    public function edit(Slideshowitem $slideshowitem)
    {
        $products = $this->productRepository->getModel()->all()->pluck('title', 'id')->all();
        $pages = $this->pageRepository->getModel()->all()->pluck('title', 'id')->all();
        return view('core::admin.edit')
            ->with(['model' => $slideshowitem, 'products' => $products, 'pages' => $pages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Slideshowitems\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $slideshowitem = $this->repository->create($request->all());

        return $this->redirect($request, $slideshowitem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Slideshowitems\Models\Slideshowitem            $slideshowitem
     * @param \TypiCMS\Modules\Slideshowitems\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Slideshowitem $slideshowitem, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $slideshowitem);
    }
}
