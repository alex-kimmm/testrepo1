<?php

namespace TypiCMS\Modules\Cardcoverblocks\Http\Controllers;

use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Cardcoverblocks\Models\Cardcoverblock;
use TypiCMS\Modules\Cardcoverblocks\Repositories\CardcoverblockInterface as Repository;

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
     * @param \TypiCMS\Modules\Cardcoverblocks\Models\Cardcoverblock $cardcoverblock
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Cardcoverblock $cardcoverblock)
    {
        $deleted = $this->repository->delete($cardcoverblock);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
