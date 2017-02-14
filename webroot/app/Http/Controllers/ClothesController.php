<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use TypiCMS\Modules\Categories\Models\Category;
use TypiCMS\Modules\Categories\Repositories\CategoryInterface;
use TypiCMS\Modules\Products\Repositories\ProductInterface;
use TypiCMS\Modules\Quotes\Repositories\QuoteInterface;
use TypiCMS\Modules\Slideshows\Repositories\SlideshowInterface;

class ClothesController extends Controller {

    protected $productRepository;
    protected $categoryRepository;
    protected $slideshowRepository;
    protected $quoteRepository;
    protected $request;

    public function __construct(ProductInterface $product,
                                CategoryInterface $category,
                                SlideshowInterface $slideshow,
                                QuoteInterface $quoteInterface,
                                Request $request) {
        $this->productRepository = $product;
        $this->categoryRepository = $category;
        $this->slideshowRepository = $slideshow;
        $this->quoteRepository = $quoteInterface;
        $this->request = $request;
    }

    public function index() {
        try {
            $boyzslider = $this->slideshowRepository->bySlug('boyz')->slideshowitems;
        } catch(Exception $e){
            $boyzslider = [];
        }

        try {
            $girlzslider = $this->slideshowRepository->bySlug('girlz')->slideshowitems;
        } catch(Exception $e){
            $girlzslider = [];
        }

        $categories = $this->categoryRepository->allBy('parent_id', CATEGORY_CLOTHING);
        $catIds = array_column($categories->toArray(), 'id');
        $products = $this->productRepository->findByCategoriesIds($catIds);
        $missed = $this->getMissedItems($products);
        $mobileMissed = $this->getRest($products,2);
        $quote = $this->quoteRepository->getFirstByUri($this->request->getPathInfo());
        $themes = [
            'red-card',
            'blue-card',
            'green-card',
            'yellow-blue-card',
            'purple-card',
            'cyan-card',
        ];

        return View::make('frontend.clothing.clothes', compact('categories', 'products','themes','boyzslider','girlzslider','missed','mobileMissed','quote'));
    }

    public function category($category_slug = null) {
        $categories = $this->categoryRepository->allBy('parent_id', CATEGORY_CLOTHING);
        $category = $this->categoryRepository->bySlug($category_slug);
        $missed = $this->getMissedItems($category->products);
        $mobileMissed = $this->getRest($category->products,2);
        try {
            $slider = $this->slideshowRepository->bySlug($category_slug)->slideshowitems;
        } catch(Exception $e){
            $slider = [];
        }

        $themes = [
            'red-card',
            'blue-card',
            'green-card',
            'yellow-blue-card',
            'purple-card',
            'cyan-card',
        ];

        return View::make('frontend.clothing.clothes_category', compact('categories', 'category', 'themes','slider','missed','mobileMissed'));
    }

    public function view($category_slug = null, $product_slug = null) {
        $categories = $this->categoryRepository->allBy('parent_id', CATEGORY_CLOTHING);
        $category = $this->categoryRepository->bySlug($category_slug);
        $product = $this->productRepository->bySlug($product_slug);
        $lastProductsByCurrentCategory = $this->productRepository->lastXProductsByCategoryWithOutConcreteProduct(3, $category->id, $product->id);
        $missed = $this->getMissedItems($lastProductsByCurrentCategory);
        $mobileMissed = $this->getRest($lastProductsByCurrentCategory,2);
        $themes = [
            'red-card',
            'blue-card',
            'purple-card'
        ];

        if($category == null || $product == null)
            abort(404);

        return View::make('frontend.clothing.clothes_view', compact('categories', 'product', 'lastProductsByCurrentCategory', 'themes','missed','mobileMissed'));
    }
}
