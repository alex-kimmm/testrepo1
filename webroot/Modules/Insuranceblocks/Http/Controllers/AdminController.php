<?php

namespace TypiCMS\Modules\Insuranceblocks\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Insuranceblocks\Http\Requests\FormRequest;
use TypiCMS\Modules\Insuranceblocks\Models\Insuranceblock;
use TypiCMS\Modules\Insuranceblocks\Models\InsuranceblockFile;
use TypiCMS\Modules\Insuranceblocks\Repositories\InsuranceblockInterface;
use TypiCMS\Modules\Insurancepages\Repositories\InsurancepageInterface;
use JavaScript;

class AdminController extends BaseAdminController
{
    var $insurancePagesRepository;

    public function __construct(InsuranceblockInterface $insuranceblock, InsurancepageInterface $insurancePagesRepository)
    {
        parent::__construct($insuranceblock);

        $this->insurancePagesRepository = $insurancePagesRepository;
    }

    public function index()
    {
        $module = $this->repository->getTable();
        $title = trans($module.'::global.name');
        $models = $this->repository->all([], true);

        JavaScript::put('models', $models);

        return view('core::admin.index')
            ->with(compact('title', 'module', 'models'));
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $model = $this->repository->getModel();
        $positions = $model->POSITIONS;
        $validFilesExtensions = InsuranceblockFile::$insurance_block_rules_valid_files_extensions;

        return view('core::admin.create')->with(compact('model', 'positions', 'validFilesExtensions'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Insuranceblocks\Models\Insuranceblock $insuranceblock
     *
     * @return \Illuminate\View\View
     */
    public function edit(Insuranceblock $insuranceblock){
        return view('core::admin.edit')->with(['model' => $insuranceblock, 'positions' => $insuranceblock->POSITIONS, 'validFilesExtensions' => InsuranceblockFile::$insurance_block_rules_valid_files_extensions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Insuranceblocks\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request) {
        $insuranceblock = $this->repository->create($request->all());

        // upload files
        if($request->all()['files'] != null && isset($request->all()['files']) && !empty($request->all()['files']) && Input::file('files')){
            $result = $this->uploadFiles(Input::file('files'), $insuranceblock);
            if(!$result['status'] == 'success') {
                return redirect()->route('admin.insuranceblocks.store')->withErrors('error', $result['message'])->withInput();
            }
        }

        return $this->redirect($request, $insuranceblock);
    }

    /**
     * @param $allFiles
     * @param $insuranceBlock
     * @return array
     */
    private function uploadFiles($allFiles, $insuranceBlock){
        $result = array('status' => 'success', 'message' => 'uploaded');
        try {
            foreach($allFiles as $file) {
                $fileSaved = Controller::globalUploadFile((env('INSURANCE_BLOCKS_FILE_UPLOAD_PATH') . $insuranceBlock->id), $file);
                if($fileSaved != null){
                    InsuranceblockFile::create(array('insuranceblock_id' => $insuranceBlock->id, 'file' => $fileSaved));
                }
            }
        } catch(\Exception $exception) {
            $result['status'] = 'fail';
            $result['message'] = $exception->getMessage();
        }

        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Insuranceblocks\Models\Insuranceblock            $insuranceblock
     * @param \TypiCMS\Modules\Insuranceblocks\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Insuranceblock $insuranceblock, FormRequest $request) {
        $this->repository->update($request->all());

        // upload files
        if($request->all()['files'] != null && isset($request->all()['files']) && !empty($request->all()['files']) && Input::file('files')){
            $result = $this->uploadFiles(Input::file('files'), $insuranceblock);
            if(!$result['status'] == 'success') {
                return redirect()->route('admin.insuranceblocks.store')->withErrors('error', $result['message'])->withInput();
            }
        }

        return $this->redirect($request, $insuranceblock);
    }
}
