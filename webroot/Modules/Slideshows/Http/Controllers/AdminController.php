<?php

namespace TypiCMS\Modules\Slideshows\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Slideshows\Http\Requests\FormRequest;
use TypiCMS\Modules\Slideshows\Models\Slideshow;
use TypiCMS\Modules\Slideshows\Repositories\SlideshowInterface;

class AdminController extends BaseAdminController
{
    public function __construct(SlideshowInterface $slideshow)
    {
        parent::__construct($slideshow);
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();

        return view('core::admin.create')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Slideshows\Models\Slideshow $slideshow
     *
     * @return \Illuminate\View\View
     */
    public function edit(Slideshow $slideshow)
    {
        return view('core::admin.edit')
            ->with(['model' => $slideshow]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Slideshows\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $slideshow = $this->repository->create($request->all());

        return $this->redirect($request, $slideshow);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Slideshows\Models\Slideshow            $slideshow
     * @param \TypiCMS\Modules\Slideshows\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Slideshow $slideshow, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $slideshow);
    }
}
