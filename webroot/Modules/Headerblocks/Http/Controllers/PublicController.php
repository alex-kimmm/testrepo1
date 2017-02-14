<?php

namespace TypiCMS\Modules\Headerblocks\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Headerblocks\Repositories\HeaderblockInterface;

class PublicController extends BasePublicController {

    public function __construct(HeaderblockInterface $headerblock) {
        parent::__construct($headerblock);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $models = $this->repository->all();

        return view('headerblocks::public.index')
            ->with(compact('models'));
    }

    /**
     * Show news.
     *
     * @return \Illuminate\View\View
     */
    public function show($slug) {
        $model = $this->repository->bySlug($slug);

        return view('headerblocks::public.show')
            ->with(compact('model'));
    }
}
