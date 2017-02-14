<?php

namespace TypiCMS\Modules\Gradients\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Gradients\Http\Requests\FormRequest;
use TypiCMS\Modules\Gradients\Models\Gradient;
use TypiCMS\Modules\Gradients\Repositories\GradientInterface;
use JavaScript;

class AdminController extends BaseAdminController
{
    public function __construct(GradientInterface $gradient)
    {
        parent::__construct($gradient);
    }

    /**
     * List models.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $module = $this->repository->getTable();
        $title = trans($module.'::global.name');
        $models = $this->repository->all([], true);
        foreach($models as $model) {
            $model->pagesCount = $model->pages->count();
        }
        JavaScript::put('models', $models);

        return view('core::admin.index')
            ->with(compact('title', 'module', 'models'));
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
     * @param \TypiCMS\Modules\Gradients\Models\Gradient $gradient
     *
     * @return \Illuminate\View\View
     */
    public function edit(Gradient $gradient)
    {
        return view('core::admin.edit')
            ->with(['model' => $gradient]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Gradients\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $gradient = $this->repository->create($request->all());

        return $this->redirect($request, $gradient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Gradients\Models\Gradient            $gradient
     * @param \TypiCMS\Modules\Gradients\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Gradient $gradient, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $gradient);
    }
}
