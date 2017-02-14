<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use TypiCMS\Modules\Cards\Repositories\CardInterface;
use TypiCMS\Modules\Insurancelandings\Repositories\InsurancelandingInterface;
use TypiCMS\Modules\Landingpages\Repositories\LandingpageInterface;
use TypiCMS\Modules\Products\Repositories\ProductInterface;
use TypiCMS\Modules\Quotes\Repositories\QuoteInterface;
use TypiCMS\Modules\Slideshowitems\Repositories\SlideshowitemInterface;
use TypiCMS\Modules\Slideshows\Repositories\SlideshowInterface;
use JavaScript;

class HomeController extends Controller {
    protected $slideshowRepository;
    protected $productRepository;
    protected $quoteRepository;
    protected $slideshowitemInterface;
    protected $cardRepository;
    protected $request;

    public function __construct(SlideshowInterface $slideshow,
                                ProductInterface $product,
                                QuoteInterface $quote,
                                SlideshowitemInterface $slideshowitemInterface,
                                Request $request,
                                LandingpageInterface $landingpageInterface,
                                CardInterface $cardInterface,
                                InsurancelandingInterface $insuranceLandingRepository
                                ) {
        $this->slideshowRepository = $slideshow;
        $this->productRepository = $product;
        $this->quoteRepository = $quote;
        $this->slideshowitemInterface = $slideshowitemInterface;
        $this->request = $request;
        $this->landingpageInterface = $landingpageInterface;
        $this->cardRepository = $cardInterface;
        $this->insuranceLandingRepository = $insuranceLandingRepository;
    }

    public function index(){
        return View::make('frontend_zz.home_live_old');
    }

    public function getHome(){

        $insuranceLanding = $this->insuranceLandingRepository->byId(1);

        $dataInsurances = array(
            'gadgetCover' => $this->productRepository->getFirstBy('category_id', CATEGORY_GADGET_INSURANCE),
            'xsCover' => $this->productRepository->getFirstBy('category_id', CATEGORY_XS_COVER)
        );

        return View::make('frontend_zz.home',[
            'dataInsurances' => $dataInsurances,
            'homePageLanding'=>$this->landingpageInterface->byId(1),
            'insuranceLanding' => $insuranceLanding
        ]);
    }

    public function index_old() {
        $videos = [];
        $images = [];
        try{
            $slideshow = $this->slideshowRepository->bySlug('home')->slideshowitems;

            foreach($slideshow as $item){
                $videos[] = $this->slideshowitemInterface->getUrl($item->video);
                $images[] = $this->slideshowitemInterface->getUrl($item->image);
            }
        } catch(Exception $e){
            $slideshow = [];
        }
        $products = $this->productRepository->all();
        $quote = $this->quoteRepository->getFirstByUri($this->request->getPathInfo());
        $missed = $this->getMissedItems($products);
        $mobileMissed = $this->getRest($products,2);
        $themes = [
            'red-card',
            'blue-card',
            'green-card',
            'yellow-blue-card',
            'purple-card',
            'cyan-card',
        ];

        return View::make('frontend.home',['products'=>$products,
                                            'themes'=>$themes,
                                            'slides'=>$slideshow,
                                            'missed' => $missed,
                                            'mobileMissed' => $mobileMissed,
                                            'videos' => $videos,
                                            'images' => $images,
                                            'quote' => $quote,
                                            ]);
    }

    public function getContactz(){
//        $quote = $this->quoteRepository->getFirstByUri($this->request->getPathInfo());
        $cards = $this->cardRepository->all();
        return View::make('frontend_zz.contactz',compact('cards'));
    }
}
