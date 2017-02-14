<?php

namespace TypiCMS\Modules\Insuranceblocks\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Insuranceblocks\Models\Insuranceblock;
use TypiCMS\Modules\Insuranceblocks\Models\InsuranceblockFile;
use TypiCMS\Modules\Insuranceblocks\Repositories\InsuranceblockInterface as Repository;

class ApiController extends BaseApiController
{

    /**
     *  Array of endpoints that do not require authorization
     *  
     */
    protected $publicEndpoints = [];

    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $model = $this->repository->create(Request::all());
        $error = $model ? false : true;

        return response()->json([
            'error' => $error,
            'model' => $model,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $updated = $this->repository->update(Request::all());

        return response()->json([
            'error' => !$updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \TypiCMS\Modules\Insuranceblocks\Models\Insuranceblock $insuranceblock
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Insuranceblock $insuranceblock)
    {
        $deleted = $this->repository->delete($insuranceblock);

        return response()->json([
            'error' => !$deleted,
        ]);
    }

    public function removeFile($id) {
        $pi = InsuranceblockFile::where('id', $id)->first();

        if(!$pi) return response()->json([ 'success' => 0 ]);

        $destinationPath = env('INSURANCE_BLOCKS_FILE_UPLOAD_PATH') . $pi->insuranceblock_id;
        $fileToDelete = $destinationPath . '/' . $pi->file;
        
        $fileToDelete = ltrim($fileToDelete, "/");

        if(File::exists($fileToDelete)) {
            File::delete($fileToDelete);
            InsuranceblockFile::destroy($id);
            return response()->json(['success' => 1]);
        }

        return response()->json([ 'success' => 0 ]);
    }
}
