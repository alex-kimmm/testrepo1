<?php

namespace TypiCMS\Modules\Categories\Http\Controllers;

use TypiCMS\Modules\Categories\Models\CategoryTranslation;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Categories\Http\Requests\FormRequest;
use TypiCMS\Modules\Categories\Models\Category;
use TypiCMS\Modules\Categories\Repositories\CategoryInterface;
use JavaScript;

class AdminController extends BaseAdminController
{
    public function __construct(CategoryInterface $category)
    {
        parent::__construct($category);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index() {
        $module = $this->repository->getTable();
        $title = trans($module.'::global.name');
        $models = $this->repository->all([], true);
        JavaScript::put('models', $models);

        $categories = Category::orderBy('parent_id')->get()->nest();

        return view('core::admin.index')
            ->with(compact('title', 'module', 'models', 'categories'));
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories[0] = "Parent";
        $categories += Category::orderBy('parent_id')->get()->nest()->listsFlattened();

        $model = $this->repository->getModel();

        return view('core::admin.create')
            ->with(compact('model', 'categories'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Categories\Models\Category $category
     *
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $categories[0] = "Parent";
        $categories += Category::orderBy('parent_id')->get()->nest()->listsFlattened();

        return view('core::admin.edit')
            ->with(['model' => $category, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Categories\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $data = $request->all();

        if($data['parent_id'] == 0) $data['parent_id'] = null;
        $category = $this->repository->create($data);

        return $this->redirect($request, $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Categories\Models\Category            $category
     * @param \TypiCMS\Modules\Categories\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Category $category, FormRequest $request)
    {
        $data = $request->all();

        if($data['parent_id'] == 0) $data['parent_id'] = null;
        $this->repository->update($data);

        return $this->redirect($request, $category);
    }

    /**
     * @param $categoryId
     * @return $this
     */
    public function delete($categoryId){
        $category = Category::find($categoryId);

        // if category contains subcategories
        if($category->parent_id == null){
            Category::where('parent_id', $categoryId)->delete();
            $category->delete();
        }

        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
