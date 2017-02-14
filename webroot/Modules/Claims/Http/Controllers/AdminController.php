<?php

namespace TypiCMS\Modules\Claims\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Claims\Http\Requests\FormRequest;
use TypiCMS\Modules\Claims\Models\Claim;

use TypiCMS\Modules\Claims\Repositories\ClaimInterface;
use TypiCMS\Modules\Claims\Repositories\ClaimGadgetInterface;
use TypiCMS\Modules\Orders\Repositories\OrderInterface;
use TypiCMS\Modules\Products\Repositories\ProductInterface;
use TypiCMS\Modules\Users\Repositories\UserInterface;
use JavaScript;

class AdminController extends BaseAdminController {

    public function __construct(ClaimInterface $claim,
                                ClaimGadgetInterface $claimGadgetInterface,
                                OrderInterface $orderRepository,
                                ProductInterface $productRepository,
                                UserInterface $userRepository) {
        parent::__construct($claim);

        $this->claimRepository = $claim;
        $this->claimGadgetInterface = $claimGadgetInterface;
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
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
     * @return $this
     */
    public function index() {
        $module = $this->repository->getTable();
        $title = trans($module.'::global.name');
        $models = $this->repository->all([], true);

        foreach($models as $model) {
//            $model->gadget = $model->gadget;
//            $model->user = $model->user;
            $model->description = strlen($model->description) > 35 ? substr($model->description, 0, 35) . " ..." : $model->description;
            $model->gadget_version = $model->gadget->version;
            $model->user_name = $model->user->first_name . " " . $model->user->last_name;
            $model->order_id = ($model->order())? $model->order->id : 0;
            $model->status_name = $model->claimStatus->name;
        }

        JavaScript::put('models', $models);

        return view('core::admin.index')
            ->with(compact('title', 'module', 'models'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Claims\Models\Claim $claim
     *
     * @return \Illuminate\View\View
     */
    public function edit(Claim $claim)
    {
        return view('core::admin.edit')
            ->with(['model' => $claim]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Claims\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $claim = $this->repository->create($request->all());

        return $this->redirect($request, $claim);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Claims\Models\Claim            $claim
     * @param \TypiCMS\Modules\Claims\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Claim $claim, FormRequest $request)
    {
        $this->repository->update($request->all());
        if($request->input('redirect_back')=='1'){
            return redirect()->back();
        }

        return $this->redirect($request, $claim);
    }

    public function view($id){
        return view('core::admin.view')->with(['model' => $this->claimRepository->byId($id)]);
    }
}
