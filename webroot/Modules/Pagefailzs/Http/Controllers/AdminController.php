<?php

namespace TypiCMS\Modules\Pagefailzs\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Headerblocks\Repositories\HeaderblockInterface;
use TypiCMS\Modules\Pagefailzs\Http\Requests\FormRequest;
use TypiCMS\Modules\Pagefailzs\Models\Pagefailz;
use TypiCMS\Modules\Pagefailzs\Repositories\PagefailzInterface;

class AdminController extends BaseAdminController
{
    public function __construct(PagefailzInterface $pagefailz,
                                HeaderblockInterface $headerBlockRepository)
    {
        parent::__construct($pagefailz);
        $this->headerBlockRepository = $headerBlockRepository;
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
     * @param \TypiCMS\Modules\Pagefailzs\Models\Pagefailz $pagefailz
     *
     * @return \Illuminate\View\View
     */
    public function edit(Pagefailz $pagefailz)
    {
        return view('core::admin.edit')
            ->with([
                'model' => $pagefailz,
                'headerBlocks' => $this->headerBlockRepository->getAllHeaderBlockFormatted(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Pagefailzs\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $pagefailz = $this->repository->create($request->all());

        return $this->redirect($request, $pagefailz);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Pagefailzs\Models\Pagefailz            $pagefailz
     * @param \TypiCMS\Modules\Pagefailzs\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Pagefailz $pagefailz, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $pagefailz);
    }
}
