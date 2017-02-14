<?php

namespace TypiCMS\Modules\Insurancelandings\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Headerblocks\Repositories\HeaderblockInterface;
use TypiCMS\Modules\Homepageblocks\Repositories\HomepageblockInterface;
use TypiCMS\Modules\Insurancelandings\Http\Requests\FormRequest;
use TypiCMS\Modules\Insurancelandings\Models\Insurancelanding;
use TypiCMS\Modules\Insurancelandings\Repositories\InsurancelandingCovercardInterface;
use TypiCMS\Modules\Insurancelandings\Repositories\InsurancelandingInterface;
use TypiCMS\Modules\Insurancelandings\Repositories\InsurancelandingCardInterface;
use TypiCMS\Modules\Insurancelandings\Repositories\InsurancelandingHomepageblockInterface;

class AdminController extends BaseAdminController {
    public function __construct(InsurancelandingInterface $insurancelanding,
                                HeaderblockInterface $headerBlockRepository,
                                HomepageblockInterface $homePageBlockRepository,
                                InsurancelandingHomepageblockInterface $insuranceLandingPageHomePageBlockRepository,
                                InsurancelandingCardInterface $insuranceLandingCardRepository,
                                InsurancelandingCovercardInterface $insuranceLandingCoverCardRepository
                                ) {
        parent::__construct($insurancelanding);

        $this->headerBlockRepository = $headerBlockRepository;
        $this->homePageBlockRepository = $homePageBlockRepository;
        $this->insuranceLandingPageHomePageBlockRepository = $insuranceLandingPageHomePageBlockRepository;
        $this->insuranceLandingCardRepository = $insuranceLandingCardRepository;
        $this->insuranceLandingCoverCardRepository = $insuranceLandingCoverCardRepository;
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
     * @param \TypiCMS\Modules\Insurancelandings\Models\Insurancelanding $insurancelanding
     *
     * @return \Illuminate\View\View
     */
    public function edit(Insurancelanding $insurancelanding)
    {

        return view('core::admin.edit')
            ->with(['model'         => $insurancelanding,
                     'headerBlocks' => $this->headerBlockRepository->getAllHeaderBlockFormatted(),
                    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Insurancelandings\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $insurancelanding = $this->repository->create($request->all());

        return $this->redirect($request, $insurancelanding);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Insurancelandings\Models\Insurancelanding            $insurancelanding
     * @param \TypiCMS\Modules\Insurancelandings\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Insurancelanding $insurancelanding, FormRequest $request) {
        // page blocks
        if(!isset($request->all()['homePageBlocks']) && empty($request->all()['homePageBlocks'])){
            $this->insuranceLandingPageHomePageBlockRepository->deleteBy('insurancelanding_id', $request->all()['id']);
        }

        // cards
        if(!isset($request->all()['cards']) && empty($request->all()['cards'])){
            $this->insuranceLandingCardRepository->deleteBy('insurancelanding_id', $request->all()['id']);
        }

        // cover cards
        if(!isset($request->all()['coverCardBlocks']) && empty($request->all()['coverCardBlocks'])){
            $this->insuranceLandingCoverCardRepository->deleteBy('insurancelanding_id', $request->all()['id']);
        }

        $this->repository->update($request->all());

        return $this->redirect($request, $insurancelanding);
    }
}
