<?php

namespace TypiCMS\Modules\Cards\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Cards\Http\Requests\FormRequest;
use TypiCMS\Modules\Cards\Models\Card;
use TypiCMS\Modules\Cards\Repositories\CardInterface;
use TypiCMS\Modules\Gradients\Repositories\GradientInterface;

class AdminController extends BaseAdminController
{
    public function __construct(CardInterface $card,
                                GradientInterface $gradientRepository
                                )
    {
        parent::__construct($card);
        $this->gradientRepository = $gradientRepository;
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();
        $model->gradients = $this->gradientRepository->all()->sortBy('id')->pluck('title', 'id');

        return view('core::admin.create')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Cards\Models\Card $card
     *
     * @return \Illuminate\View\View
     */
    public function edit(Card $card)
    {
        $card->gradients = $this->gradientRepository->all()->sortBy('id')->pluck('title', 'id');
        return view('core::admin.edit')
            ->with(['model' => $card]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Cards\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $card = $this->repository->create($request->all());

        return $this->redirect($request, $card);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Cards\Models\Card            $card
     * @param \TypiCMS\Modules\Cards\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Card $card, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $card);
    }
}
