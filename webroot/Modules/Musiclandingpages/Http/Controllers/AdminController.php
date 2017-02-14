<?php

namespace TypiCMS\Modules\Musiclandingpages\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Musiclandingpages\Http\Requests\FormRequest;
use TypiCMS\Modules\Musiclandingpages\Models\Musiclandingpage;
use TypiCMS\Modules\Musiclandingpages\Repositories\MusiclandingpageInterface;
use TypiCMS\Modules\Headerblocks\Repositories\HeaderblockInterface;
use TypiCMS\Modules\Homepageblocks\Repositories\HomepageblockInterface;
use TypiCMS\Modules\Musiclandingpages\Repositories\MusiclandingpageHomepageblockInterface;
use TypiCMS\Modules\Musiclandingpages\Repositories\MusiclandingpageCardInterface;
use JavaScript;

class AdminController extends BaseAdminController
{
    public function __construct(MusiclandingpageInterface $musiclandingpage,
                                HeaderblockInterface $headerBlockRepository,
                                HomepageblockInterface $homePageBlockRepository,
                                MusiclandingpageHomepageblockInterface $musicLandingPageHomePageBlockRepository,
                                MusiclandingpageCardInterface $musicLandingPageCardRepository) {
        parent::__construct($musiclandingpage);

        $this->headerBlockRepository = $headerBlockRepository;
        $this->homePageBlockRepository = $homePageBlockRepository;
        $this->musicLandingPageHomePageBlockRepository = $musicLandingPageHomePageBlockRepository;
        $this->musicLandingPageCardRepository = $musicLandingPageCardRepository;
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
            $model->count_PageBlocks = count($this->musicLandingPageHomePageBlockRepository->getAllBy('musiclandingpage_id', $model->id));
            $model->count_Cards = count($this->musicLandingPageCardRepository->getAllBy('musiclandingpage_id', $model->id));
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
     * @param \TypiCMS\Modules\Musiclandingpages\Models\Musiclandingpage $musiclandingpage
     *
     * @return \Illuminate\View\View
     */
    public function edit(Musiclandingpage $musiclandingpage) {
        return view('core::admin.edit')->with(['model' => $musiclandingpage, 'headerBlocks' => $this->headerBlockRepository->getAllHeaderBlockFormatted()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Musiclandingpages\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request) {
        $musiclandingpage = $this->repository->create($request->all());

        return $this->redirect($request, $musiclandingpage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Musiclandingpages\Models\Musiclandingpage            $musiclandingpage
     * @param \TypiCMS\Modules\Musiclandingpages\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Musiclandingpage $musiclandingpage, FormRequest $request) {
        // page blocks
        if(!isset($request->all()['homePageBlocks']) && empty($request->all()['homePageBlocks'])){
            $this->musicLandingPageHomePageBlockRepository->deleteBy('musiclandingpage_id', $request->all()['id']);
        }

        // cards
        if(!isset($request->all()['cards']) && empty($request->all()['cards'])){
            $this->musicLandingPageCardRepository->deleteBy('musiclandingpage_id', $request->all()['id']);
        }

        $this->repository->update($request->all());

        return $this->redirect($request, $musiclandingpage);
    }
}
