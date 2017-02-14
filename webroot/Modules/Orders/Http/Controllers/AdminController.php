<?php

namespace TypiCMS\Modules\Orders\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Claims\Repositories\ClaimInterface;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Orders\Http\Requests\FormRequest;
use TypiCMS\Modules\Orders\Models\Order;
use TypiCMS\Modules\Orders\Repositories\OrderInterface;
use TypiCMS\Modules\Users\Repositories\UserInterface;
use JavaScript;

class AdminController extends BaseAdminController
{
    public function __construct(OrderInterface $order,
                                ClaimInterface $claim,
                                UserInterface $userRepository) {
        parent::__construct($order);

        $this->orderRepository = $order;
        $this->claimRepository = $claim;
        $this->userRepository = $userRepository;
    }

    /**
     * @return $this
     */
    public function index()
    {
        $module = $this->repository->getTable();
        $title = trans($module.'::global.name');
        $models = $this->repository->all([], true);

        foreach($models as $item) {
            $item->products = $item->products;
//            $item->user = $item->user;
            $item->user_name = $item->user->first_name . " " . $item->user->last_name;
        }

        JavaScript::put('models', $models);

        return view('core::admin.index')
            ->with(compact('title', 'module', 'models'));
    }

    public function csv() {

        $q = $this->orderRepository->getModel();

        if(Input::has('from')) {
            $q = $q->where('created_at', '>=', Input::get('from'));
        }

        if(Input::has('to')) {
            $q = $q->where('created_at', '<=', Input::get('to'));
        }

        $rsp = $q->get()->toArray();

        $data = [];
        foreach($rsp as $item) {
            unset($item['image']);
            unset($item['thumb']);
            unset($item['slug']);
            unset($item['summary']);
            unset($item['body']);
            $data[] = $item;
        }

        Excel::create('Orders_' . date("Y-m-d_H:i:s"), function($excel) use($data) {
            $excel->sheet('Orders', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv');
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
     * @param \TypiCMS\Modules\Orders\Models\Order $order
     *
     * @return \Illuminate\View\View
     */
    public function edit(Order $order)
    {
        return view('core::admin.edit')
            ->with(['model' => $order]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Orders\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $order = $this->repository->create($request->all());

        return $this->redirect($request, $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Orders\Models\Order            $order
     * @param \TypiCMS\Modules\Orders\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Order $order, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $order);
    }

    /**
     * @param $id
     * @return $this
     */
    public function view($id){
        $order = $this->orderRepository->byId($id);
        $user = $this->userRepository->byId($order->user_id);

        return view('core::admin.view')->with(['model' => $order, 'products' => $order->products, 'user' => $user]);
    }
}
