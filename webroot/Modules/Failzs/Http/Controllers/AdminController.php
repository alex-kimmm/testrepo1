<?php

namespace TypiCMS\Modules\Failzs\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Input;
use JavaScript;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Failzs\Http\Requests\FormRequest;
use TypiCMS\Modules\Failzs\Models\Failz;
use TypiCMS\Modules\Failzs\Models\FailzSetting;
use TypiCMS\Modules\Failzs\Repositories\FailzInterface;

class AdminController extends BaseAdminController
{
    public function __construct(FailzInterface $failz)
    {
        parent::__construct($failz);
    }

    public function index()
    {
        $module = $this->repository->getTable();
        $title = trans($module.'::global.name');
        $models = $this->repository->all([], true);
        JavaScript::put('models', $models);

        $settings = FailzSetting::all();

        if(count($settings) < 4) $settings = null;

        $last = $this->repository->latest(1);
        if(count($last) > 0) $last = $last[0]; else $last = null;

        return view('core::admin.index')
            ->with(compact('title', 'module', 'models', 'settings', 'last'));
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
     * @param \TypiCMS\Modules\Failzs\Models\Failz $failz
     *
     * @return \Illuminate\View\View
     */
    public function edit(Failz $failz)
    {
        return view('core::admin.edit')
            ->with(['model' => $failz]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Failzs\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $failz = $this->repository->create($request->all());

        return $this->redirect($request, $failz);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Failzs\Models\Failz            $failz
     * @param \TypiCMS\Modules\Failzs\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Failz $failz, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $failz);
    }

    public function giphy() {
        $data = Input::all();

        if(!Input::has('search') || !Input::has('limit')){
            return redirect()->back()->with("error", "Please fill both fields");
        }

        $rsp = Artisan::call('giphy:refresh', [
            'search' => $data['search'],
            'limit' => $data['limit'],
            'check_running' => 'false'
        ]);

        if($rsp == 0) return redirect()->back()->with("success", "List updated");
        else return redirect()->back()->with("error", "Something went wrong, try again later");
    }

    public function settings() {
        $data = Input::all();

        foreach($data as $key => $item) {
            $set = FailzSetting::where('key', $key)->first();
            if($set) {
                $set->value = $item;
                $set->save();
            }
        }

        return redirect()->back()->with("success", "Settings updated");
    }

    public function changeGiphyStatus($status) {
        FailzSetting::where('key', 'running')->update(['value' => $status]);
        return redirect()->back();
    }
}
