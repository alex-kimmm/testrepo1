<?php

namespace TypiCMS\Modules\Sizes\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Sizes\Http\Requests\FormRequest;
use TypiCMS\Modules\Sizes\Models\Size;
use TypiCMS\Modules\Sizes\Repositories\SizeInterface;

class AdminController extends BaseAdminController
{
    public function __construct(SizeInterface $size)
    {
        parent::__construct($size);
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
     * @param \TypiCMS\Modules\Sizes\Models\Size $size
     *
     * @return \Illuminate\View\View
     */
    public function edit(Size $size)
    {
        return view('core::admin.edit')
            ->with(['model' => $size]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Sizes\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $size = $this->repository->create($request->all());

        return $this->redirect($request, $size);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Sizes\Models\Size            $size
     * @param \TypiCMS\Modules\Sizes\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Size $size, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $size);
    }
}
