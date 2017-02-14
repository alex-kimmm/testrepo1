<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use TypiCMS\Modules\Products\Models\Product;

class ProductsController extends Controller {

    public function index() {

        return View::make('frontend.products',
            [
                'products'=> Product::all(),
            ]);
    }
}
