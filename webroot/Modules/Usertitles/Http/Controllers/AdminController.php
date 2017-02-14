<?php

namespace TypiCMS\Modules\Usertitles\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Usertitles\Http\Requests\FormRequest;
use TypiCMS\Modules\Usertitles\Models\Usertitle;
use TypiCMS\Modules\Usertitles\Repositories\UsertitleInterface;

class AdminController extends BaseAdminController
{
    public function __construct(UsertitleInterface $usertitle)
    {
        parent::__construct($usertitle);
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
     * @param \TypiCMS\Modules\Usertitles\Models\Usertitle $usertitle
     *
     * @return \Illuminate\View\View
     */
    public function edit(Usertitle $usertitle)
    {
        return view('core::admin.edit')
            ->with(['model' => $usertitle]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Usertitles\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $usertitle = $this->repository->create($request->all());

        return $this->redirect($request, $usertitle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Usertitles\Models\Usertitle            $usertitle
     * @param \TypiCMS\Modules\Usertitles\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Usertitle $usertitle, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $usertitle);
    }
}
