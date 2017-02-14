<?php
namespace TypiCMS\Modules\Headerblocks\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Headerblocks\Http\Requests\FormRequest;
use TypiCMS\Modules\Headerblocks\Models\Headerblock;
use TypiCMS\Modules\Headerblocks\Repositories\HeaderblockInterface;
use TypiCMS\Modules\Gradients\Repositories\GradientInterface;
use JavaScript;

class AdminController extends BaseAdminController {

    public function __construct(HeaderblockInterface $headerblock,
                                GradientInterface $gradientRepository) {
        parent::__construct($headerblock);

        $this->gradientRepository = $gradientRepository;
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $model = $this->repository->getModel();

        $position = $model->POSITIONS;
        $model->gradients = $this->gradientRepository->all()->sortBy('id')->lists('title', 'id');
        JavaScript::put('models', $model);

        return view('core::admin.create')->with(compact('model', 'position'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Headerblocks\Models\Headerblock $headerblock
     *
     * @return \Illuminate\View\View
     */
    public function edit(Headerblock $headerblock) {
        $position = $headerblock->POSITIONS;
        $headerblock->gradients = $this->gradientRepository->all()->sortBy('id')->lists('title', 'id');;

        return view('core::admin.edit')->with(['model' => $headerblock, 'position' => $position]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Headerblocks\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request) {
        $headerblock = $this->repository->create($request->all());

        return $this->redirect($request, $headerblock);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Headerblocks\Models\Headerblock            $headerblock
     * @param \TypiCMS\Modules\Headerblocks\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Headerblock $headerblock, FormRequest $request) {
        $this->repository->update($request->all());

        return $this->redirect($request, $headerblock);
    }
}
