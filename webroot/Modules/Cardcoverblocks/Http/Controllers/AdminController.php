<?php

namespace TypiCMS\Modules\Cardcoverblocks\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Cardcoverblocks\Http\Requests\FormRequest;
use TypiCMS\Modules\Cardcoverblocks\Models\Cardcoverblock;
use TypiCMS\Modules\Cardcoverblocks\Repositories\CardcoverblockInterface;
use JavaScript;

class AdminController extends BaseAdminController {

    public function __construct(CardcoverblockInterface $cardcoverblock) {
        parent::__construct($cardcoverblock);
    }

    /**
     * @return $this
     */
    public function index() {
        $module = $this->repository->getTable();
        $title = trans($module.'::global.name');
        $models = $this->repository->all([], true);

        foreach($models as $model) {
            $model->card_title = strip_tags($model->card_title);
        }
        JavaScript::put('models', $models);

        return view('core::admin.index')->with(compact('title', 'module', 'models'));
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
     * @param \TypiCMS\Modules\Cardcoverblocks\Models\Cardcoverblock $cardcoverblock
     *
     * @return \Illuminate\View\View
     */
    public function edit(Cardcoverblock $cardcoverblock)
    {
        return view('core::admin.edit')
            ->with(['model' => $cardcoverblock]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Cardcoverblocks\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $cardcoverblock = $this->repository->create($request->all());

        return $this->redirect($request, $cardcoverblock);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Cardcoverblocks\Models\Cardcoverblock            $cardcoverblock
     * @param \TypiCMS\Modules\Cardcoverblocks\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Cardcoverblock $cardcoverblock, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $cardcoverblock);
    }
}
