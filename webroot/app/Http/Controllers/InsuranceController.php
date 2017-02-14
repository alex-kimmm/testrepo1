<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use TypiCMS\Modules\Blocks\Repositories\BlockInterface;
use TypiCMS\Modules\Categories\Models\CategoryTranslation;
use TypiCMS\Modules\Categories\Repositories\CategoryInterface;
use TypiCMS\Modules\Insurancepages\Repositories\InsurancepageInterface;
use TypiCMS\Modules\Products\Repositories\ProductInterface;
use TypiCMS\Modules\Quotes\Repositories\QuoteInterface;
use TypiCMS\Modules\Slideshows\Repositories\SlideshowInterface;

use TypiCMS\Modules\Cardcoverblocks\Repositories\CardcoverblockInterface;
use TypiCMS\Modules\Insurancelandings\Repositories\InsurancelandingInterface;

class InsuranceController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $slideshowRepository;
    protected $blockInterface;
    protected $quoteRepository;
    protected $request;

    public function __construct(ProductInterface $product,
                                CategoryInterface $category,
                                SlideshowInterface $slideshow,
                                BlockInterface $blockInterface,
                                QuoteInterface $quoteInterface,
                                CardcoverblockInterface $cardCoverBlockInterface,
                                InsurancelandingInterface $insuranceLandingRepository,

                                InsurancepageInterface $insurancePageRepository,

                                Request $request) {
        $this->productRepository = $product;
        $this->categoryRepository = $category;
        $this->slideshowRepository = $slideshow;
        $this->blockInterface = $blockInterface;
        $this->quoteRepository = $quoteInterface;

        $this->cardCoverBlockInterface = $cardCoverBlockInterface;
        $this->insuranceLandingRepository = $insuranceLandingRepository;

        $this->insurancePageRepository = $insurancePageRepository;

        $this->request = $request;

        $this->middleware('web', ['only' => [
            'view',
        ]]);
    }

    public function postPrecompleteInsurance(Request $formRequest){

        $productId = $formRequest->get('product_id');
        $productCover = $this->productRepository->byId($productId);
        if($productCover){
            $redirectLink = route('insurance.getcover', ['category_slug' => $productCover->category->slug], false);

            return redirect()
                ->to($redirectLink)
                ->withInput([
                    'product_id'        => $productCover->id,
                    'attributeOptionID' => $formRequest->get($productCover->id . '_attributeOptionID') ,
                    'tempinceptiondate' => $formRequest->get('date') ,
                ]);
        }
        return redirect()
            ->back();
    }

    public function index() {
        //TO DO: get first online insurance landing, NOT get it by id
        $insuranceLanding = $this->insuranceLandingRepository->byId(1);

        return View::make('frontend_zz.insurances.index', compact('insuranceLanding'));
    }

//    public function category($category_slug = null) {
//        $categories = $this->categoryRepository->allBy('parent_id', CATEGORY_INSURANCE);
//        $category = $this->categoryRepository->bySlug($category_slug);
//        return View::make('frontend.insurances.insurance_category', compact('categories', 'category'));
//    }

    public function about($product_slug = null) {
        // temporary use directly the model
        $insurancePageAbout = $this->insurancePageRepository->findByStepAndCategory(1, CategoryTranslation::where('slug', $product_slug)->first()->category_id);

        return View::make('frontend_zz.insurances.steps.about', compact('insurancePageAbout'));
    }

    public function benefits($product_slug = null) {
        // temporary use directly the model
        try {
            $insurancePageBenefits = $this->insurancePageRepository->findByStepAndCategory(2, CategoryTranslation::where('slug', $product_slug)->first()->category_id);
        }
        catch(Exception $e) {
            $insurancePageBenefits = [];
        }

        if(!$insurancePageBenefits) abort(404);

        return View::make('frontend_zz.insurances.steps.benefits', compact('insurancePageBenefits'));
    }

    public function getCover($category_slug = null) {
        // temporary use directly the model
        $categoryID = CategoryTranslation::where('slug', $category_slug)->first()->category_id;
        $insurancePageGetCover = $this->insurancePageRepository->findByStepAndCategory(3, $categoryID);

        $productCover = $this->productRepository->getFirstBy('category_id',$categoryID) ; //bySlug($product_slug);
        $zhit_product = $this->productRepository->getFirstBy('category_id', CATEGORY_ZHIT);

        return View::make('frontend_zz.insurances.steps.get_cover', compact('insurancePageGetCover','productCover','zhit_product'));
    }

    public function view($product_slug = null) {
        $categories = $this->categoryRepository->allBy('parent_id', CATEGORY_INSURANCE);
        $catIds = array_column($categories->toArray(), 'id');
        $products = $this->productRepository->getModel()->whereIn('category_id', $catIds)->get();

        try {
            $insurance_block = $this->blockInterface->allBy('name', 'gadget-insurance-text-card')->toArray()[0]['translations'][0]['body'];
        }
        catch(Exception $e) {
            $insurance_block = '';
        }

        try {
            $sidebar_blocks = $this->blockInterface->all()->filter(function($value){
                return (strpos($value->name, 'sidebar-slider') !== false);
            })->filter(function($value) {
                return $value->status = 1;
            });
            $sidebar_blocks = $sidebar_blocks->values();
        }
        catch(Exception $e) {
            $sidebar_blocks = [];
        }

        $product = null;
        $related_product = null;

        $product = $this->productRepository->bySlug($product_slug);

        if($product != null) {
            foreach ($products as $p) {
                if ($p->status == 1 && $p->id != $product->id) {
                    $related_product = $p;
                    break;
                }
            }
        }

        try {
            $priceOptions = \GuzzleHttp\json_decode($product->options)->priceOptions;
        }
        catch(Exception $e) {
            $priceOptions = [];
        }
        $formatPriceOptions = [];
        $optionsPrice = [];
        foreach($priceOptions as $priceOption){
            $formatPriceOptions[$priceOption->attributeOptionID] = $priceOption->optionName;
            $optionsPrice[$priceOption->attributeOptionID] = $priceOption->soldPricetoCustomer;
        }

        $periods = [
            PAY_PER_PERIOD   => 'month',
            PAY_PER_YEAR    => 'year',
        ];

        if($product == null)
            abort(404);

        return View::make('frontend.insurances.insurance_view',
            compact('categories', 'product', 'related_product', 'formatPriceOptions', 'optionsPrice', 'periods','insurance_block','sidebar_blocks'));
    }

    public function view_new($product_slug = null) {

        $categories = $this->categoryRepository->allBy('parent_id', CATEGORY_INSURANCE);
        $catIds = array_column($categories->toArray(), 'id');
        $products = $this->productRepository->getModel()->whereIn('category_id', $catIds)->get();

        $empty_steps = [1,2,3];
        $step = Input::has('step') ? Input::get('step') : 1;

        if(($key = array_search($step, $empty_steps)) !== false) {
            unset($empty_steps[$key]);
        }

        $product = null;
        $related_product = null;

        $product = $this->productRepository->bySlug($product_slug);

        if($product->category_id == CATEGORY_GADGET_INSURANCE) {
            $insurance_page = $product->category->insurancePage()->step($step)->get()->first();
            if ($insurance_page == null) abort(404);
        }

        if($product->category_id == CATEGORY_XS_COVER) {
            try {
                $insurance_block = $this->blockInterface->allBy('name', 'gadget-insurance-text-card')->toArray()[0]['translations'][0]['body'];
            }
            catch(Exception $e) {
                $insurance_block = '';
            }

            try {
                $sidebar_blocks = $this->blockInterface->all()->filter(function($value){
                    return (strpos($value->name, 'sidebar-slider') !== false);
                })->filter(function($value) {
                    return $value->status = 1;
                });
                $sidebar_blocks = $sidebar_blocks->values();
            }
            catch(Exception $e) {
                $sidebar_blocks = [];
            }
        }

        if($product != null) {
            foreach ($products as $p) {
                if ($p->status == 1 && $p->id != $product->id) {
                    $related_product = $p;
                    break;
                }
            }
        }

        try {
            $priceOptions = \GuzzleHttp\json_decode($product->options)->priceOptions;
        }
        catch(Exception $e) {
            $priceOptions = [];
        }
        $formatPriceOptions = [];
        $optionsPrice = [];
        foreach($priceOptions as $priceOption){
            $formatPriceOptions[$priceOption->attributeOptionID] = $priceOption->optionName;
            $optionsPrice[$priceOption->attributeOptionID] = $priceOption->soldPricetoCustomer;
        }

        $periods = [
            PAY_PER_YEAR    => 'year',
            PAY_PER_PERIOD   => 'month',
        ];

        if($product->category_id == CATEGORY_GADGET_INSURANCE)
            return View::make('frontend.insurances.insurance_view_new', compact('related_product', 'step', 'insurance_page', 'product', 'empty_steps', 'formatPriceOptions', 'optionsPrice', 'periods'));
        else if($product->category_id == CATEGORY_XS_COVER)
            return View::make('frontend.insurances.insurance_view', compact('categories', 'product', 'related_product', 'formatPriceOptions', 'optionsPrice', 'periods','insurance_block','sidebar_blocks'));

        // if nothing
        abort(404); return null;
    }

    // ajax call
    public function asyncSteps() {
        $insurance_id = Input::get('insuranceId');
        $steps = Input::get('steps');

        $data = [];
        foreach($steps as $step) {

            $product = $this->productRepository->byId($insurance_id);
            $insurance_page = $product->category->insurancePage()->step($step)->get()->first();

            if($insurance_page == null)
                return response()->json(null);

            if($step == 3) {

                $categories = $this->categoryRepository->allBy('parent_id', CATEGORY_INSURANCE);
                $catIds = array_column($categories->toArray(), 'id');
                $products = $this->productRepository->getModel()->whereIn('category_id', $catIds)->get();

                $related_product = null;

                if($product != null) {
                    foreach ($products as $p) {
                        if ($p->status == 1 && $p->id != $product->id) {
                            $related_product = $p;
                            break;
                        }
                    }
                }

                try {
                    $priceOptions = \GuzzleHttp\json_decode($product->options)->priceOptions;
                }
                catch(Exception $e) {
                    $priceOptions = [];
                }
                $formatPriceOptions = [];
                $optionsPrice = [];
                foreach($priceOptions as $priceOption){
                    $formatPriceOptions[$priceOption->attributeOptionID] = $priceOption->optionName;
                    $optionsPrice[$priceOption->attributeOptionID] = $priceOption->soldPricetoCustomer;
                }

                $periods = [
                    PAY_PER_YEAR    => 'year',
                    PAY_PER_PERIOD   => 'month',
                ];

                $step_data = View::make('frontend.insurances.inc.step_' . $step, compact('related_product', 'insurance_page', 'product', 'empty_steps', 'formatPriceOptions', 'optionsPrice', 'periods'))->render();
            }
            else {
                $step_data = View::make('frontend.insurances.inc.step_' . $step, compact('insurance_page'))->render();
            }

            $data[] = [
                'step' => $step,
                'data' => $step_data
            ];
        }

        return response()->json($data);
    }
}
