<?php

namespace TypiCMS\Modules\Faceofzzlandings\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Headerblocks\Repositories\HeaderblockInterface;
use TypiCMS\Modules\Homepageblocks\Repositories\HomepageblockInterface;
use TypiCMS\Modules\Faceofzzlandings\Http\Requests\FormRequest;
use TypiCMS\Modules\Faceofzzlandings\Models\Faceofzzlanding;
use TypiCMS\Modules\Faceofzzlandings\Repositories\FaceofzzlandingInterface;

class AdminController extends BaseAdminController
{
    public function __construct(FaceofzzlandingInterface $faceofzzlanding,
                                HeaderblockInterface $headerBlockRepository,
                                HomepageblockInterface $homePageBlockRepository)
    {
        parent::__construct($faceofzzlanding);
        $this->headerBlockRepository = $headerBlockRepository;
        $this->homePageBlockRepository = $homePageBlockRepository;
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();
        $headerBlocks = $this->headerBlockRepository->getAllHeaderBlockFormatted();

        return view('core::admin.create')
            ->with(compact('model','headerBlocks'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Faceofzzlandings\Models\Faceofzzlanding $faceofzzlanding
     *
     * @return \Illuminate\View\View
     */
    public function edit(Faceofzzlanding $faceofzzlanding)
    {
        return view('core::admin.edit')
            ->with(['model' => $faceofzzlanding,'headerBlocks' => $this->headerBlockRepository->getAllHeaderBlockFormatted()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Faceofzzlandings\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $faceofzzlanding = $this->repository->create($request->all());

        return $this->redirect($request, $faceofzzlanding);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Faceofzzlandings\Models\Faceofzzlanding            $faceofzzlanding
     * @param \TypiCMS\Modules\Faceofzzlandings\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Faceofzzlanding $faceofzzlanding, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $faceofzzlanding);
    }
}
