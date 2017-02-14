<?php

namespace TypiCMS\Modules\Landingpages\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Headerblocks\Repositories\HeaderblockInterface;
use TypiCMS\Modules\Homepageblocks\Repositories\HomepageblockInterface;
use TypiCMS\Modules\Landingpages\Http\Requests\FormRequest;
use TypiCMS\Modules\Landingpages\Models\Landingpage;
use TypiCMS\Modules\Landingpages\Repositories\LandingpageInterface;
use TypiCMS\Modules\Landingpages\Repositories\LandingpageHomepageblockInterface;
use TypiCMS\Modules\Landingpages\Repositories\LandingpageCardInterface;
use JavaScript;

class AdminController extends BaseAdminController {

    public function __construct(LandingpageInterface $landingpage,
                                HeaderblockInterface $headerBlockRepository,
                                HomepageblockInterface $homePageBlockRepository,
                                LandingpageHomepageblockInterface $landingPageHomePageBlockRepository,
                                LandingpageCardInterface $landingPageCardRepository){
        parent::__construct($landingpage);

        $this->headerBlockRepository = $headerBlockRepository;
        $this->homePageBlockRepository = $homePageBlockRepository;
        $this->landingPageHomePageBlockRepository = $landingPageHomePageBlockRepository;
        $this->landingPageCardRepository = $landingPageCardRepository;
    }

    /**
     * @return $this
     */
    public function index() {
        $module = $this->repository->getTable();
        $title = trans($module . '::global.name');
        $models = $this->repository->all([], true);

        foreach($models as $model) {
            $model->headerBlockTitle = $model->headerBlock->title;
            $model->count_PageBlocks = count($this->landingPageHomePageBlockRepository->getAllBy('landingpage_id', $model->id));
            $model->count_Cards = count($this->landingPageCardRepository->getAllBy('landingpage_id', $model->id));
        }

        JavaScript::put('models', $models);

        return view('core::admin.index')->with(compact('title', 'module', 'models'));
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $model = $this->repository->getModel();
        $headerBlocks = $this->headerBlockRepository->getAllHeaderBlockFormatted();

        return view('core::admin.create')->with(compact('model', 'headerBlocks'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Landingpages\Models\Landingpage $landingpage
     *
     * @return \Illuminate\View\View
     */
    public function edit(Landingpage $landingpage) {
        return view('core::admin.edit')->with(['model' => $landingpage, 'headerBlocks' => $this->headerBlockRepository->getAllHeaderBlockFormatted()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Landingpages\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $landingpage = $this->repository->create($request->all());

        return $this->redirect($request, $landingpage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Landingpages\Models\Landingpage            $landingpage
     * @param \TypiCMS\Modules\Landingpages\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Landingpage $landingpage, FormRequest $request) {
        // page blocks
        if(!isset($request->all()['homePageBlocks']) && empty($request->all()['homePageBlocks'])){
            $this->landingPageHomePageBlockRepository->deleteBy('landingpage_id', $request->all()['id']);
        }

        // cards
        if(!isset($request->all()['cards']) && empty($request->all()['cards'])){
            $this->landingPageCardRepository->deleteBy('landingpage_id', $request->all()['id']);
        }

        $this->repository->update($request->all());

        return $this->redirect($request, $landingpage);
    }
}
