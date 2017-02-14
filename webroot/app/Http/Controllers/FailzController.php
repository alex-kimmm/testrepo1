<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use TypiCMS\Modules\Cardcoverblocks\Repositories\CardcoverblockInterface;
use TypiCMS\Modules\Failzs\Models\Failz;
use TypiCMS\Modules\Failzs\Models\FailzLike;
use TypiCMS\Modules\Failzs\Repositories\FailzInterface;
use TypiCMS\Modules\Pagefailzs\Repositories\PagefailzInterface;
use TypiCMS\Modules\Products\Repositories\ProductInterface;

class FailzController extends Controller {

    protected $failzRepository;
    protected $productRepository;
    protected $pagefailzRepository;
    protected $cardcoverblockRepository;

    public function __construct(FailzInterface $failzInterface,
                                ProductInterface $product,
                                PagefailzInterface $pagefailzInterface,
                                CardcoverblockInterface $cardcoverblockInterface) {
        $this->failzRepository = $failzInterface;
        $this->productRepository = $product;
        $this->pagefailzRepository = $pagefailzInterface;
        $this->cardcoverblockRepository = $cardcoverblockInterface;
    }

    public function index($id = null) {
        $pageFailz = $this->pagefailzRepository->byId(1);
        $left_option = $pageFailz->failzOptionsLeft[rand(0,count($pageFailz->failzOptionsLeft)-1)];
        $right_option = $pageFailz->failzOptionsRight[rand(0,count($pageFailz->failzOptionsRight)-1)];
        $failz = $this->getResultsByPage(null, 10);

        $gadgets = $this->cardcoverblockRepository->bySlug('gadgets');
        $xs_card = $this->cardcoverblockRepository->bySlug('xs');
        array_splice( $failz, 3, 0, [$gadgets] );
        array_splice( $failz, 8, 0, [$xs_card] );

        $fail = null;

        if($id)
            $fail = $this->failzRepository->byId($id);

//        dd($failz);
        return view('frontend_zz.failz.index', compact('pageFailz','failz','left_option','right_option', 'fail'));
    }

    private function getResultsByPage($page = 1, $offset = 12) {
        $failz = $this->failzRepository->byPage($page, $offset);

        $user = Auth::user();
        $user_id = $user ? $user->id : 0;

        foreach($failz->items as $f) {
            $likeable = false;
            if(count(FailzLike::where(['user_id' => $user_id, 'failz_id' => $f->id])->get()) == 0) {
                $likeable = true;
            }
            $f->likeable = $likeable;
        }

        return $failz->items;
    }

    public function getPaginate($page = 1, $offset = 12) {
        $failz = $this->getResultsByPage($page, $offset);
        return View::make('frontend_zz.failz.failz_item', compact('failz'));
    }

    public function like() {

        if(!Auth::check()) {
            header('HTTP/1.1 403 Forbidden');
            header('Content-Type: application/json; charset=UTF-8');
            return response()->json(['message' => 'Please Sign In', 'code' => 'forbidden']);
        }

        if(!Input::has('id')) {
            header('HTTP/1.1 404 Not found');
            header('Content-Type: application/json; charset=UTF-8');
            return response()->json(['message' => 'Not found', 'code' => 'not_found']);
        }

        $fail_id = Input::get('id');

        $user = Auth::user();

        $like = FailzLike::where(['user_id' => $user->id, 'failz_id' => $fail_id]);

        if(count($like->get()) > 0) {
            $like->delete();
            return response()->json(['to_display' => 'Like', 'count' => count($like->get())]);
        }
        else {
            FailzLike::insert(['user_id' => $user->id, 'failz_id' => $fail_id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            return response()->json(['to_display' => 'Dislike', 'count' => count($like->get())]);
        }
    }

    public function getFailz($failz_id){
        $fail = $this->failzRepository->byId($failz_id);
        $products = $this->productRepository->all()->random(3);
        $mobileMissed = $this->getRest($products,2);
        $themes = [
            'red-card',
            'blue-card',
            'green-card',
            'yellow-blue-card',
            'purple-card',
            'cyan-card',
        ];
        return View::make('frontend.failz.failz_detail', compact('fail','products','themes','mobileMissed'));
    }
}
