<?php

namespace TypiCMS\Modules\Homepageblocks\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Homepageblocks\Http\Requests\FormRequest;
use TypiCMS\Modules\Homepageblocks\Models\Homepageblock;
use TypiCMS\Modules\Homepageblocks\Repositories\HomepageblockInterface;

class AdminController extends BaseAdminController {

    public function __construct(HomepageblockInterface $homepageblock) {
        parent::__construct($homepageblock);
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $model = $this->repository->getModel();
        $position = $model->POSITIONS;

        return view('core::admin.create')->with(compact('model', 'position'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Homepageblocks\Models\Homepageblock $homepageblock
     *
     * @return \Illuminate\View\View
     */
    public function edit(Homepageblock $homepageblock) {
        $position = $homepageblock->POSITIONS;

        return view('core::admin.edit')->with(['model' => $homepageblock, 'position' => $position]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Homepageblocks\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request) {
        $homepageblock = $this->repository->create($request->all());

        return $this->redirect($request, $homepageblock);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Homepageblocks\Models\Homepageblock            $homepageblock
     * @param \TypiCMS\Modules\Homepageblocks\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Homepageblock $homepageblock, FormRequest $request) {
        $this->repository->update($request->all());

        return $this->redirect($request, $homepageblock);
    }
}
