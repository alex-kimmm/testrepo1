<?php

namespace TypiCMS\Modules\Homepageblocks\Http\Controllers;

use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Homepageblocks\Models\Homepageblock;
use TypiCMS\Modules\Homepageblocks\Repositories\HomepageblockInterface as Repository;

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
     * @param \TypiCMS\Modules\Homepageblocks\Models\Homepageblock $homepageblock
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Homepageblock $homepageblock)
    {
        $deleted = $this->repository->delete($homepageblock);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
