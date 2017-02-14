<?php

namespace TypiCMS\Modules\Musiccards\Http\Controllers;

use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Musiccards\Http\Requests\FormRequest;
use TypiCMS\Modules\Musiccards\Models\Musiccard;
use TypiCMS\Modules\Musiccards\Repositories\MusiccardInterface;
use JavaScript;

class AdminController extends BaseAdminController
{
    public function __construct(MusiccardInterface $musiccard)
    {
        parent::__construct($musiccard);
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
        $models = $this->repository->allSortedByColumn('position',true, [], true);
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
     * @param \TypiCMS\Modules\Musiccards\Models\Musiccard $musiccard
     *
     * @return \Illuminate\View\View
     */
    public function edit(Musiccard $musiccard)
    {
        return view('core::admin.edit')
            ->with(['model' => $musiccard]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Musiccards\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $musiccard = $this->repository->create($request->all());

        return $this->redirect($request, $musiccard);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Musiccards\Models\Musiccard            $musiccard
     * @param \TypiCMS\Modules\Musiccards\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Musiccard $musiccard, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $musiccard);
    }

    /**
     * Sort list.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sort()
    {
        $this->repository->sort(Request::all());

        return response()->json([
            'error'   => false,
            'message' => trans('global.Items sorted'),
        ], 200);
    }
}
