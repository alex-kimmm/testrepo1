<?php

namespace TypiCMS\Modules\Products\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Products\Models\Product;
use TypiCMS\Modules\Products\Models\ProductImage;
use TypiCMS\Modules\Products\Repositories\ProductInterface as Repository;

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
     * @param \TypiCMS\Modules\Products\Models\Product $product
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $deleted = $this->repository->delete($product);

        return response()->json([
            'error' => !$deleted,
        ]);
    }


    /**
     * @param $product_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload($product_id) {
        $imageDestinationPath = env('PRODUCT_IMAGE_UPLOAD_PATH');

        if($imageDestinationPath == "") {
            throw new Exception('Destination directory has not been supplied.');
        }

        $imageDestinationPath = $imageDestinationPath . $product_id . '/';

        $destinationPath = public_path($imageDestinationPath);
        if(!is_dir($destinationPath)){
            @mkdir($destinationPath);
        }

        if (!is_writable($destinationPath) || !file_exists($destinationPath)) {
            throw new Exception('Destination directory does not exist or not writable!');
        }

        $extension = Input::file('image')->getClientOriginalExtension();
        $fileName = $product_id . '_' . time() . uniqid() . '.' . $extension;
        Input::file('image')->move($destinationPath, $fileName);

        if(File::exists($destinationPath . '/' . $fileName)) {
            $productImage = ProductImage::create(['product_id' => $product_id, 'image' => $fileName]);
            return response()->json([ 'success' => 1, 'product_image_id' => $productImage->id, 'image' => $imageDestinationPath . $fileName ]);
        }
        else {
            return response()->json([ 'success' => 0 ]);
        }
    }


    public function removeImage($id) {
        $pi = ProductImage::where('id', $id)->first();

        if(!$pi) return response()->json([ 'success' => 0 ]);

        $destinationPath = env('PRODUCT_IMAGE_UPLOAD_PATH') . $pi->product_id;
        $fileToDelete = $destinationPath . '/' . $pi->image;

        $fileToDelete = ltrim($fileToDelete, "/");

        if(File::exists($fileToDelete)) {
            File::delete($fileToDelete);
            ProductImage::destroy($id);
            return response()->json(['success' => 1]);
        }

        return response()->json([ 'success' => 0 ]);
    }
}
