<?php

namespace TypiCMS\Modules\Quotes\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Quotes\Http\Requests\FormRequest;
use TypiCMS\Modules\Quotes\Models\Quote;
use TypiCMS\Modules\Quotes\Repositories\QuoteInterface;

class AdminController extends BaseAdminController
{
    public function __construct(QuoteInterface $quote)
    {
        parent::__construct($quote);
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();
        $position = $model->POSITIONS;
        return view('core::admin.create')
            ->with(compact('model','position'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Quotes\Models\Quote $quote
     *
     * @return \Illuminate\View\View
     */
    public function edit(Quote $quote)
    {
        $position = $quote->POSITIONS;
        return view('core::admin.edit')
            ->with(['model' => $quote,'position'=>$position]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Quotes\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $quote = $this->repository->create($request->all());

        return $this->redirect($request, $quote);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Quotes\Models\Quote            $quote
     * @param \TypiCMS\Modules\Quotes\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Quote $quote, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $quote);
    }
}
