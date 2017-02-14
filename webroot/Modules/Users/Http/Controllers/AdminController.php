<?php

namespace TypiCMS\Modules\Users\Http\Controllers;

use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Users\Http\Requests\FormRequest;
use TypiCMS\Modules\Users\Models\User;
use TypiCMS\Modules\Users\Repositories\UserInterface;
use TypiCMS\Modules\Usertitles\Repositories\UsertitleInterface;
use JavaScript;

class AdminController extends BaseAdminController
{
    protected $userTitleRepository;
    public function __construct(UserInterface $user, UsertitleInterface $userTitle)
    {
        parent::__construct($user);

        $this->userTitleRepository = $userTitle;
    }

    /**
    * @return $this
    */
    public function index() {
        $module = $this->repository->getTable();
        $title = trans($module.'::global.name');
        $models = $this->repository->all([], true);

        foreach($models as $model){
            $model->usertitle = $this->userTitleRepository->byId($model->usertitle_id);
        }

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
        $selectedGroups = [];

        return view('core::admin.create')
            ->with(compact('model', 'selectedGroups'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Users\Models\User $user
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $permissions = $user->permissions;
        $selectedGroups = $user->groups->getDictionary();

        return view('core::admin.edit')
            ->with([
                'model'          => $user,
                'permissions'    => $permissions,
                'selectedGroups' => $selectedGroups,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Users\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $model = $this->repository->create($request->except('_url'));

        return $this->redirect($request, $model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Users\Models\User               $user
     * @param \TypiCMS\Modules\Users\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, FormRequest $request)
    {
        $this->repository->update($request->except('_url'));

        return $this->redirect($request, $user);
    }

    /**
     * Update User's preferences.
     *
     * @return void
     */
    public function postUpdatePreferences()
    {
        $this->repository->updatePreferences(Request::all());
    }
}
