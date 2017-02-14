<?php

namespace App\Http\Controllers;


use App\Services\MailService;
use App\Libraries\Array2XML;
use App\Libraries\XML2Array;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use LukePOLO\LaraCart\Facades\LaraCart;
use Omnipay\Omnipay;
use Omnipay\SecureTrading\Gateway;
use TypiCMS\Modules\Orders\Repositories\EloquentOrder;
use TypiCMS\Modules\Orders\Repositories\EloquentOrderProduct;

class OrdersController extends Controller {

    protected $orderRepository;
    protected $orderProductRepository;

    public function __construct(EloquentOrder $eloquentOrder, EloquentOrderProduct $eloquentOrderProduct) {
        $this->orderRepository = $eloquentOrder;
        $this->orderProductRepository = $eloquentOrderProduct;
    }

    public function getCheckout() {
        $cart = LaraCart::getItems();
        $user = Auth::user();

        // TODO : change -> create user on the fly
        $user_id = $user ? $user->id : 1;

        $order = $this->orderRepository->create([
            'title'          => 'Order from ' . Carbon::now(),
            'body'           => 'Order from ' . Carbon::now(),
            'status'         => 1,
            'price'           => LaraCart::total($formatted = false, $withDiscount = true),
            'user_id'        => $user_id,
            'payment_status' => 'Initialisation'
        ]);

        if($order) {

            foreach($cart as $item) {

                $options = $item->options;

                $options['hash'] = $item->getHash();

                $this->orderProductRepository->create([
                    'order_id'   => $order->id,
                    'product_id' => $item->id,
                    'quantity'   => $item->qty,
                    'options'    => json_encode($options)
                ]);
            }

            // send email to user
            $contentData['subject'] = 'Order checkout';
            $contentData['body'] = 'Thank you for checkout ...';
            MailService::sendMailUserCheckout($user, $contentData);

            echo "ordered " . count($cart) . " items. <a href='/products'>Back</a>";
            LaraCart::destroyCart();
        }
        else abort(500);
    }

    public function postThreeProcessed() {

        // make simple AUTH (or AUTH + SUBSCRIPTION) xml call plus 3D Secure
        // with some new parameters, see 5.1.1 http://www.securetrading.com/files/documentation/STPP-3D-Secure.pdf

        // example : PaymentsController.getCreate()

        $data = Input::all();

        echo "<pre>";
        print_r('Here make a payment xml call<br>');
        print_r($data);
    }
}
