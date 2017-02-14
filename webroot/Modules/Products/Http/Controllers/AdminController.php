<?php

namespace TypiCMS\Modules\Products\Http\Controllers;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\IWEPApiController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Orders\Models\OrderProduct;
use TypiCMS\Modules\Products\Http\Requests\FormRequest;
use TypiCMS\Modules\Products\Models\Product;
use TypiCMS\Modules\Products\Models\ProductImage;
use TypiCMS\Modules\Categories\Repositories\CategoryInterface;
use TypiCMS\Modules\Products\Repositories\ProductInterface;
use JavaScript;

class AdminController extends BaseAdminController {
    private $IWEPApiControllerInstance;

    public function __construct(ProductInterface $product, CategoryInterface $category)
    {
        parent::__construct($product);

        $this->IWEPApiControllerInstance = IWEPApiController::getInstance();
        $this->categoryRepository = $category;
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
            $model->category = $model->category;
            $model->category_name = $model->category->title;

            //Do not delete insurance products, and products already purchased
            $model->actionDelete = ($model->isInsurance())? false : (OrderProduct::where('product_id', $model->id)->count() == 0);
        }

        JavaScript::put('models', $models);

        return view('core::admin.index')
            ->with(compact('title', 'module', 'models'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Products\Models\Product $product
     *
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('core::admin.edit')
            ->with(['model' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Products\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request) {
        $product = $this->repository->create($request->all());

        // upload images
        if(Input::file('product_photo')) {
            $result = $this->uploadProductImages(Input::file('product_photo'), $product);
            if(!$result['status'] == 'success') {
                return redirect()->route('admin.products.store')->withErrors('error', $result['message'])->withInput();
            }
        }

        return $this->redirect($request, $product);
    }

    private function uploadProductImages($allImages, $product){
        $result = array('status' => 'success', 'message' => 'uploaded');
        try {
            foreach($allImages as $image) {
                $imageSaved = Controller::globalUploadFile((env('PRODUCT_IMAGE_UPLOAD_PATH') . $product->id), $image);
                if($imageSaved != null){
                    ProductImage::create(array('image' => $imageSaved, 'product_id' => $product->id));
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
     * @param \TypiCMS\Modules\Products\Models\Product            $product
     * @param \TypiCMS\Modules\Products\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Product $product, FormRequest $request) {
        $this->repository->update($request->all());

        // upload images
        if(Input::file('product_photo')) {
            $result = $this->uploadProductImages(Input::file('product_photo'), $product);
            if(!$result['status'] == 'success'){
                redirect()->route('admin.products.update')->withErrors('error', $result['message'])->withInput();
            }
        }

        return $this->redirect($request, $product);
    }

    private function generateSKUForInsurance($productID){
        return 'IWEP_' . $productID;
    }

    public function insurances(){

        try {
            $iwepProducts = $this->IWEPApiControllerInstance->getProducts();

            if (count($iwepProducts)) {
                foreach ($iwepProducts as $iwepProduct) {

                        $productOptionsDB = [
                            'productID' => $iwepProduct->productID,
                            'mtaAllowed' => $iwepProduct->mtaAllowed,
                            'priceOptions' => $iwepProduct->options,
                            'pdf_documents' => $iwepProduct->pdf_documents,
                        ];

                        $sku = $this->generateSKUForInsurance($iwepProduct->productID);

                        //Check if such a product already exists
                        $ProductOfSKU = Product::where('sku',$sku)->first(); //$this->repository->getFirstBy('sku', $sku);

                        //On update from API, you can change only price and options
                        $productData = [
                            'sku' => $sku,
//                            'price' => $priceOption->soldPricetoCustomer,
                            'options' => \GuzzleHttp\json_encode($productOptionsDB),
                        ];

                        if (!$ProductOfSKU) {
                            $productData['featured'] = '1';
                            $productData['category_id'] = IWEPApiController::getMappingCategoryFor($iwepProduct->productID);

                            $title = $iwepProduct->name; //$priceOption->productName . ' ' . $priceOption->optionName;
                            $productData['en'] = [
                                'title' => $title,
                                'slug' => Str::slug($title),
                                'status' => '1',
                                'summary' => '',
                                'body' => '',
                            ];

                            Product::create($productData);
                        } else {
                            $ProductOfSKU->update($productData);
                        }
                }

                return redirect()->back()->with("success", "Insurance Products successfully loaded from API");
            } else {
                return redirect()->back()->with("error", "Something went wrong, please try again later");
            }
        } catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

}
