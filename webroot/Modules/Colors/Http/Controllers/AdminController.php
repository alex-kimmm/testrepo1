<?php

namespace TypiCMS\Modules\Colors\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Colors\Http\Requests\FormRequest;
use TypiCMS\Modules\Colors\Models\Color;
use TypiCMS\Modules\Colors\Repositories\ColorInterface;

class AdminController extends BaseAdminController
{
    public function __construct(ColorInterface $color)
    {
        parent::__construct($color);
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
     * @param \TypiCMS\Modules\Colors\Models\Color $color
     *
     * @return \Illuminate\View\View
     */
    public function edit(Color $color)
    {
        return view('core::admin.edit')
            ->with(['model' => $color]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Colors\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $color = $this->repository->create($request->all());

        return $this->redirect($request, $color);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Colors\Models\Color            $color
     * @param \TypiCMS\Modules\Colors\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Color $color, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $color);
    }
}
