<?php

namespace TypiCMS\Modules\Insurancepages\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Insurancepages\Http\Requests\FormRequest;
use TypiCMS\Modules\Insurancepages\Models\Insurancepage;
use TypiCMS\Modules\Insurancepages\Repositories\InsurancepageInterface;
use TypiCMS\Modules\Categories\Repositories\CategoryInterface;
use TypiCMS\Modules\Gradients\Repositories\GradientInterface;
use JavaScript;

class AdminController extends BaseAdminController {

    public function __construct(InsurancepageInterface $insurancepage,
                                CategoryInterface $categoryRepository,
                                GradientInterface $gradientRepository) {
        parent::__construct($insurancepage);

        $this->categoryRepository = $categoryRepository;
        $this->gradientRepository = $gradientRepository;
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $model = $this->repository->getModel();

        $model->steps = Insurancepage::$steps;
        $model->categories = $this->categoryRepository->allBy('parent_id', CATEGORY_INSURANCE)->sortBy('id');
        $model->gradients = $this->gradientRepository->all()->sortBy('id')->lists('title', 'id');
        JavaScript::put('models', $model);

        return view('core::admin.create')->with(compact('model'));
    }

    /**
     * @return $this
     */
    public function index() {
        $module = $this->repository->getTable();
        $title = trans($module.'::global.name');
        $models = $this->repository->all([], true);

        foreach($models as $model) {
            $model->category = $this->categoryRepository->byId($model->category_id);
            $model->gradient = $this->gradientRepository->byId($model->gradient_id);
        }
        JavaScript::put('models', $models);

        return view('core::admin.index')->with(compact('title', 'module', 'models'));
    }

    /**
     * @param Insurancepage $insurancepage
     * @return $this
     */
    public function edit(Insurancepage $insurancepage) {
        $insurancepage->steps = Insurancepage::$steps;
        $insurancepage->categories = $this->categoryRepository->allBy('parent_id', CATEGORY_INSURANCE)->sortBy('id');
        $insurancepage->gradients = $this->gradientRepository->all()->sortBy('id')->lists('title', 'id');;

        return view('core::admin.edit')->with(['model' => $insurancepage]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Insurancepages\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request) {
        $insurancepage = $this->repository->create($request->all());

        return $this->redirect($request, $insurancepage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Insurancepages\Models\Insurancepage            $insurancepage
     * @param \TypiCMS\Modules\Insurancepages\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Insurancepage $insurancepage, FormRequest $request) {
        $this->repository->update($request->all());

        return $this->redirect($request, $insurancepage);
    }
}
