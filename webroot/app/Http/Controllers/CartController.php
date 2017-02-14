<?php

namespace App\Http\Controllers;

use App\Http\IWEPApiController;
use App\Http\Requests\CartFormRequest;
use App\Libraries\ST\STManager;
use App\Http\Requests\InsuranceFormRequest;
use App\Services\MailService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use LukePOLO\LaraCart\CartItem;
use LukePOLO\LaraCart\Facades\LaraCart;
use TypiCMS\Modules\Orders\Models\OrderPayment;
use TypiCMS\Modules\Orders\Models\OrderPolicy;
use TypiCMS\Modules\Orders\Repositories\EloquentOrder;
use TypiCMS\Modules\Orders\Repositories\EloquentOrderPolicy;
use TypiCMS\Modules\Orders\Repositories\EloquentOrderProduct;
use TypiCMS\Modules\Products\Models\Product;
use TypiCMS\Modules\Products\Repositories\ProductInterface;
use TypiCMS\Modules\Users\Repositories\UserInterface;

class CartController extends Controller {

    protected $productRepository;
    protected $userRepository;

    protected $orderRepository;
    protected $orderProductRepository;

    public static $insuranceInitialPrice = PAYMENT_INSURANCE_INITIAL_PRICE;
    public static $insuranceNrOfPayPeriods = PAYMENT_RECUR_FINAL;

    public function __construct(ProductInterface $productInterface, UserInterface $userInterface, EloquentOrder $eloquentOrder, EloquentOrderProduct $eloquentOrderProduct, EloquentOrderPolicy $eloquentOrderPolicy)
    {
        $this->productRepository = $productInterface;
        $this->userRepository = $userInterface;

        $this->orderRepository = $eloquentOrder;
        $this->orderProductRepository = $eloquentOrderProduct;
        $this->orderPolicyRepository = $eloquentOrderPolicy;

        $this->middleware('web', ['only' => [
            'getIndex',
        ]]);
    }

    public static function  priceTextFormatForCartItem( CartItem $cartItem ){
        $cartItemOptions = $cartItem->options;
        if(
            isset($cartItemOptions['is_recurring']) &&
            $cartItemOptions['is_recurring'] &&
            isset($cartItemOptions['priceRecurringNrOfPayPeriods'])
        ){
            return '&pound;' . $cartItemOptions['price_initial'] . ' + ' . $cartItemOptions['priceRecurringNrOfPayPeriods'] . '*&pound;' . $cartItemOptions['price_recurring'];
        } elseif(isset($cartItemOptions['price_final'])){
            return '&pound;' . $cartItemOptions['price_final'];
        }
        return '&pound;0.0';
    }

    public static function getPriceObjForProductByPayPeriod(Product $product, $attributeOptionID, $payPeriod){
        $totalPrice = $product->getFormattedPriceForOptionId($attributeOptionID);
        $insuranceInitialPrice = self::$insuranceInitialPrice;
        $insuranceNrOfPayPeriods = self::$insuranceNrOfPayPeriods;

        if($product->isGadgetInsurance()) {
            if( ($totalPrice - $insuranceInitialPrice <= 0) && $payPeriod == PAY_PER_PERIOD ) {
                return null;
            }

            $policyPriceRecurring = ($payPeriod == PAY_PER_PERIOD) ? (($totalPrice - $insuranceInitialPrice) / $insuranceNrOfPayPeriods) : 0;
            $policyPriceRecurring = formatPrice($policyPriceRecurring);
            $policyPriceInitial = ($payPeriod == PAY_PER_PERIOD) ? $insuranceInitialPrice : $totalPrice;
        }
        else {
            $policyPriceRecurring = ($payPeriod == PAY_PER_PERIOD) ? ($totalPrice / $insuranceNrOfPayPeriods) : 0;
            $policyPriceRecurring = formatPrice($policyPriceRecurring);
            $policyPriceInitial = ($payPeriod == PAY_PER_PERIOD) ? $policyPriceRecurring : $totalPrice;
        }

        $priceObj = new \stdClass();
        $priceObj->priceInitial = floatval($policyPriceInitial);
        $priceObj->priceRecurring = floatval($policyPriceRecurring);
        $priceObj->priceRecurringNrOfPayPeriods = $insuranceNrOfPayPeriods;
        $priceObj->priceTotal = floatval($totalPrice);

        return $priceObj;
    }

    public function postAddInsurance(InsuranceFormRequest $formRequest){
        $product = $this->productRepository->byId($formRequest->input('product_id'));

        if(!$product->isInsurance()) {
            return redirect()
                ->back()
                ->withInput($formRequest->input())
                ->withErrors(['Not insurance product']);
        } elseif (count(LaraCart::find(['category_id' => $product->category_id])) > 0 && $product->isGadgetInsurance()) {
            return redirect()
                ->back()
                ->withInput($formRequest->input())
                ->withErrors(['Can it be - you already currently have this product in your <a class="blue-link" href="/basket">basket</a>. Please complete the purchase before buying another policy.']);
        } elseif (
            $product->isXSCover() &&
            isset(LaraCart::find(['category_id' => $product->category_id])[0]->options['iwep_data']['car']) &&
            LaraCart::find(['category_id' => $product->category_id])[0]->options['iwep_data']['car'] == $formRequest->get('car')
        ) {
            return redirect()
                ->back()
                ->withInput($formRequest->input())
                ->withErrors(['Can it be - you already currently have a product with this plate number in your <a class="blue-link" href="/basket">basket</a>. Please complete the purchase before buying another policy.']);
        }

        $productOptions = \GuzzleHttp\json_decode($product->options);

        $formRequestData = $formRequest->all();

        $inception_data = null;

        $date = DateTime::createFromFormat('d/m/Y', $this->getSafeValue($formRequestData, 'tempinceptiondate'));
        $inception_data =  $date->format('Y-m-d');

        $iwepProductData = [
            'productID'             => $productOptions->productID,
            'postcode'              => $this->getSafeValue($formRequestData, 'postcode'),
            'attributeOptionID'     => $this->getSafeValue($formRequestData, 'attributeOptionID'),
            'firstname'             => $this->getSafeValue($formRequestData, 'firstname'),
            'lastname'              => $this->getSafeValue($formRequestData, 'lastname'),
            'email'                 => $this->getSafeValue($formRequestData, 'email'),
            'telno'                 => $this->getSafeValue($formRequestData, 'telno'),
            'town'                  => $this->getSafeValue($formRequestData, 'town'),
            'address1'              => $this->getSafeValue($formRequestData, 'address1'),
            'tempinceptiondate'     => $inception_data,
            'car'                   => $this->getSafeValue($formRequestData, 'car'),
        ];


        $quantity = 1; //You can have in cart only 1 insurance of certain type

        $cartData = [
            'is_insurance' => 1,
            'category_id'  => $product->category_id,
            'iwep_data'    => $iwepProductData,
        ];

        $priceObj = CartController::getPriceObjForProductByPayPeriod($product, $formRequest->input('attributeOptionID'), $formRequest->input('pay_period'));
        if(is_null($priceObj)){
            return redirect()->back()->withInput($formRequest->input())->withErrors(['Error. PLease try again later']);
        }

        $cartData['is_recurring'] = 0;
        if($formRequest->input('pay_period') == PAY_PER_PERIOD){
            $cartData['price_recurring'] = $priceObj->priceRecurring;
            $cartData['is_recurring'] = 1;
            $cartData['priceRecurringNrOfPayPeriods'] = $priceObj->priceRecurringNrOfPayPeriods;
        }
        $cartData['price_initial'] = $priceObj->priceInitial;
        $cartData['price_final'] = formatPrice($priceObj->priceTotal);

        $cartItem = LaraCart::add($product->id, $product->title, $quantity, $priceObj->priceInitial,
            $cartData,
            $taxable = true
        );

        if($formRequest->has('likeZhitPhone') && $formRequest->input('likeZhitPhone') == LIKE_ZHIT_PHONE_YES) {

            $zhit_product = $this->productRepository->getFirstBy('category_id', CATEGORY_ZHIT);

            if($zhit_product) {

                $data_attr['is_insurance'] = 0;
                $data_attr['category_id'] = $zhit_product->category_id;
                $data_attr['price_final'] = $zhit_product->price;
                $data_attr['related_to_cart_item'] = $cartItem->itemHash;
                $zhit_quantity = 1;

                LaraCart::add($zhit_product->id, $zhit_product->title, $zhit_quantity, $zhit_product->price,
                    $data_attr,
                    $taxable = true
                );
            }
        }

        if($cartItem){
            return redirect()->route('cart.view')->with('success', $product->title . ' was added to cart');
        }

        return redirect()
            ->back()
            ->withInput($formRequest->input())
            ->withErrors(['Error. PLease try again later']);

    }

    public function postAdd(){

        $data = Input::all();

        if(!isset($data['id']) ||
            (isset($data['attr']) && !is_array($data['attr'])) ||
            (isset($data['quantity']) && intval($data['quantity'])<=0)
        ){
            return $this->formatJson(STATUS_ERROR);
        }

        if(!isset($data['quantity'])){
            $data['quantity'] = 1;
        }

        if(!isset($data['attr'])){
            $data['attr'] = [];
        }

        $product = $this->productRepository->byId($data['id']); // Product::find($data['id']);

        if(!$product->isInsurance() && (!is_array($data['attr']) || $data['attr']['color'] == "" || $data['attr']['size'] == "") ) {
            return $this->formatJson(STATUS_ERROR,[
                'items_count' => $this->countCartItems()
            ]);
        }

        $status = STATUS_ERROR;

        if($product){

            if($product->isInsurance() && count(LaraCart::find(['category_id' => $product->category_id]))){
                return $this->formatJson(STATUS_ERROR,[
                    'items_count' => $this->countCartItems(),
                    'error_message' => 'Error. You can add only 1 product of this type'
                ]);
            }

            $data['attr']['is_insurance'] = ($product->isInsurance())? 1 : 0;
            $data['attr']['category_id'] = $product->category_id;
            $data['attr']['price_final'] = $product->price;

            $item = LaraCart::add($product->id, $product->title, $data['quantity'], $product->price,
                $data['attr'],
                $taxable = true
            );

            if($item){
                $status = STATUS_SUCCESS;
            }
        }

        return $this->formatJson($status,[
            'items_count' => $this->countCartItems()
        ]);
    }

    public function createPoliciesForInsurances(&$errorsFromApi){

        $successfullyCreatedPolicy = true;

        $insuranceItems = LaraCart::find(['is_insurance' => 1]);

        if(count($insuranceItems)>0){
            foreach($insuranceItems as $insuranceItem){
                $insuranceProduct = $this->productRepository->byId($insuranceItem->id);

                if($insuranceProduct){
                    try {

                        $iwep_data = $insuranceItem->iwep_data;
                        $iwep_data['is_recurring'] = $insuranceItem->is_recurring;
                        $iwep_data['price_recurring'] = $insuranceItem->price_recurring;
                        $iwep_data['price_initial'] = $insuranceItem->price_initial;

                        $IWEPApiControllerInstance = IWEPApiController::getInstance();
                        $policy = $IWEPApiControllerInstance->createPolicy($iwep_data);

                        try {
                            $transactionData = $IWEPApiControllerInstance->startTransaction($policy->quoteID);
                            $transactionData->zz_inception_date = $insuranceItem->iwep_data['tempinceptiondate'];
                            $transactionData->insuranceItem = $insuranceItem;

                            Session::put('insurance_transaction_data',
                                [
                                    $policy->quoteID => $transactionData,
                                ]
                            );

                        } catch (\Exception $e){

                        }

                    } catch (\Exception $e){
                        $errorsFromApi = 'Error in creating the insurance policy: </br>' . $e->getMessage(); // \GuzzleHttp\json_decode($e->getMessage(),true);

                        $successfullyCreatedPolicy = false;
                        break;
                    }
                }
            }
        }

        return $successfullyCreatedPolicy;

    }

    public function postCheckout(CartFormRequest $request){
        if(!Auth::check() && $request->input('cartAccountOptRadio') == CART_OPTION_ACCOUNT_CREATE_ACCOUNT){
            //Create user on the fly
            $userData = [
                'activated' => 1,
                'email' => $request->input('accountEmail'),
                'first_name' => $request->input('accountFirstName'),
                'last_name' => $request->input('accountLastName'),
                'password' => $request->input('accountPassword'),
            ];

            $user = $this->userRepository->create($userData);
            Auth::loginUsingId($user->id);
        }
        elseif(!Auth::check() && $request->input('cartAccountOptRadio') == CART_OPTION_ACCOUNT_LOGIN){
            //Login user
            if (!Auth::attempt([
                                'email'     => $request->input('loginEmail'),
                                'password'  => $request->input('loginPassword'),
                ])
            ) return redirect()
                ->back()
                ->withInput($request->input())
                ->with('error', 'Invalid User Credentials');
        }

        $authUser = Auth::user();

        $cart = LaraCart::getItems();

        $data = $request->all();

        if($data['billingAsDelivery']) {
            $data['billingFirstName'] = $data['deliveryFirstName'];
            $data['billingPhone'] = $data['deliveryPhone'];
            $data['billingPostcode'] = $data['deliveryPostcode'];
            $data['billingAddress1'] = $data['deliveryAddress1'];
            $data['billingCity'] = $data['deliveryCity'];
        }

        $deliveryNameParts = explode(" ", $data['deliveryFirstName']);
        $billingNameParts = explode(" ", $data['billingFirstName']);

        if( empty($deliveryNameParts) )
            return redirect()
                ->back()
                ->withInput($request->input())
                ->with('error', 'Please enter delivery Name and Surname');

        if( empty($billingNameParts) )
            return redirect()
                ->back()
                ->withInput($request->input())
                ->with('error', 'Please enter billing Name and Surname');

        $deliveryFirstName = count($deliveryNameParts) >= 2 ? $deliveryNameParts[0] : $data['deliveryFirstName'];
        $deliveryLastName = count($deliveryNameParts) >= 2 ? $deliveryNameParts[1] : $data['deliveryFirstName'];

        $billingFirstName = count($billingNameParts) >= 2 ? $billingNameParts[0] : $data['billingFirstName'];
        $billingLastName = count($billingNameParts) >= 2 ? $billingNameParts[1] : $data['billingFirstName'];

        //First search if in cart are products of type insurance, if yes,first create policies for them on IWEP, if everything
        //is ok, add products to order
        if($this->createPoliciesForInsurances($errorsFromApi)) {

            $order = $this->orderRepository->create([
                'title' => 'Order from ' . Carbon::now(),
                'body' => 'Order from ' . Carbon::now(),
                'status' => 1,
                'price' => LaraCart::total($formatted = false, $withDiscount = true),
                'price_final' => $this->getTotalPriceFinal(),
                'user_id' => $authUser->id,
                'payment_status' => 'Initialisation',
                'options' => \GuzzleHttp\json_encode([
                    'deliveryFirstName' => $deliveryFirstName,
                    'deliveryLastName' => $deliveryLastName,
                    'deliveryEmail' => $request->input('deliveryEmail'),
                    'deliveryPostcode' => $data['deliveryPostcode'],
                    'deliveryAddress1' => $data['deliveryAddress1'],
                    'deliveryCity' => $data['deliveryCity'],
                    'deliveryPhone' => $data['deliveryPhone'],
                    'billingFirstName' => $billingFirstName,
                    'billingLastName' => $billingLastName,
                    'billingPostcode' => $data['billingPostcode'],
                    'billingAddress1' => $data['billingAddress1'],
                    'billingCity' => $data['billingCity'],
                    'billingPhone' => $data['billingPhone']
                ]),
            ]);


            if ($order) {

                $insuranceTransactionData = Session::pull('insurance_transaction_data');
                if($insuranceTransactionData){

                    Session::put('order_insurance_transaction_data',
                        [
                            $order->id => $insuranceTransactionData,
                        ]
                    );

                    foreach($insuranceTransactionData as $policyId => $policyObj){

                        //Timestamps are not generated, create through model, till now
//                        $this->orderPolicyRepository->create([
//                            'order_id' => $order->id,
//                            'policy_id' => $policyId,
//                        ]);

                        OrderPolicy::create([
                            'order_id' => $order->id,
                            'policy_id' => $policyId,
                        ]);
                    }

                }

                foreach ($cart as $item) {

                    $options = $item->options;

                    $options['hash'] = $item->getHash();

                    $this->orderProductRepository->create([
                        'order_id' => $order->id,
                        'product_id' => $item->id,
                        'quantity' => $item->qty,
                        'options' => json_encode($options)
                    ]);
                }

                $cardNameParts = explode(" ", $request->input('cardUserName'));
                $cardFirstName = count($cardNameParts) >= 2 ? $cardNameParts[0] : $request->input('cardUserName');
                $cardLastName = count($cardNameParts) >= 2 ? $cardNameParts[1] : $request->input('cardUserName');

                $formParams = [
                    'middle'       => '',
                    'prefix'       => '',
                    'last'         => $billingLastName,
                    'first'        => $billingFirstName,

                    'telephone'    => $request->input('billingPhone'),
                    'town'         => $data['billingCity'],
                    'street'       => $data['billingAddress1'],
                    'postcode'     => $data['billingPostcode'],
                    'premise'      => $data['billingAddress1'],

                    //card
                    'number'       => $request->input('cardNumber'),
                    'expiryMonth'  => $request->input('cardExpireMonth'),
                    'expiryYear'   => $request->input('cardExpireYear'),
                    'cvv'          => $request->input('cardCVV'),
                    'firstName'    => $cardFirstName,
                    'lastName'     => $cardLastName,
                    'currency'     => 'GBP',

                    //Billing
                    'order_id'        => $order->id,
                    'price_fixed'     => formatPrice($order->price),
                    'price_recurring' => '',
                ];

                if($this->cartContainsRecurring()){
                    $formParams['price_recurring'] = formatPrice($this->cartGetPriceRecurring());
                }

                return redirect()->route('payments.checkout')->with('payData',$formParams);
            }
        }

        return redirect()
            ->back()
            ->withInput($request->input())
            ->withErrors([$errorsFromApi]);
    }

    private function getTotalPriceFinal(){
        $finalPrice = 0.00;
        $cartItems = LaraCart::getItems();
        if(count($cartItems)>0){
            foreach($cartItems as $cartItem){
                $finalPrice += ($cartItem->qty * $cartItem->price_final);
            }
        }
        return formatPrice($finalPrice);
    }

    public function formatJson($status = STATUS_ERROR, $data = []){

        if($status == STATUS_ERROR && !isset($data['error_message'])){
            $data['error_message'] = 'Something went wrong, try again later';
        }

        return response()->json([
            'status' => $status,
            'data' => $data,
        ]);
    }

    private function cartGetPriceRecurring(){
        $recurringItems = LaraCart::find(['is_recurring' => 1]);
        $recurringPrice = floatval(0);
        if(count($recurringItems)){
            foreach($recurringItems as $recurringItem){
                $recurringPrice += floatval($recurringItem->price_recurring);
            }
        }
        return $recurringPrice;
    }

    private function getIPTTotal(){
        $items = LaraCart::find(['is_insurance' => 1]);

        $iptTotal = floatval(0);
        if(count($items)){
            foreach($items as $item){
                $iptTotal += floatval($item->price * 0.095);
            }
        }

        return $iptTotal;
    }

    private function getVATTotal(){
        $items = LaraCart::find(['is_insurance' => 0]);

        $vatTotal = floatval(0);
        if(count($items)){
            foreach($items as $item){
                $vatTotal += floatval($item->price * $item->qty * 0.2);
            }
        }
        return $vatTotal;
    }

    private function cartContainsRecurring(){
        return (count(LaraCart::find(['is_recurring' => 1])) > 0);
    }
    private function cartContainsInsurance(){
        return (count(LaraCart::find(['is_insurance' => 1])) > 0);
    }

    public function getDefaultCartFormData(){
        $iwepData = $defaultData = [];
        $insuranceItems = LaraCart::find(['is_insurance' => 1]);
        if(count($insuranceItems)>0){
            $insuranceItem = array_pop($insuranceItems);
            $iwepData = $insuranceItem->iwep_data;
        }

        $user = $this->getLoggedInUser();
        $defaultData['name'] = (is_null($user))?
            $this->getSafeValue($iwepData,'firstname') . ' ' . $this->getSafeValue($iwepData,'lastname') :
            $user->first_name . ' ' . $user->last_name ;
        $defaultData['name'] = trim($defaultData['name']);
        $defaultData['telno'] = $this->getSafeValue($iwepData,'telno');
        $defaultData['email'] = $this->getSafeValue($iwepData,'email');
        $defaultData['postcode'] = $this->getSafeValue($iwepData,'postcode');
        $defaultData['address1'] = $this->getSafeValue($iwepData,'address1');
        $defaultData['town'] = $this->getSafeValue($iwepData,'town');
        return $defaultData;
    }

    public function getIndex() {

        //dd(LaraCart::getItems());

        $months = []; for($i=1;$i<=12;$i++){ $months[$i]= $i;}
        $currentYear = intval(\Carbon\Carbon::now()->format('Y'));
        $previousYears = []; for($i=$currentYear;$i>$currentYear-20;$i--){ $previousYears[$i]= $i;}
        $nextYears = []; for($i=$currentYear;$i<$currentYear+20;$i++){ $nextYears[$i]= $i;}

        $currentMonths = []; for($i=1;$i<=12;$i++){ $currentMonths[$i] = $i;}

        $cartItems = LaraCart::getItems();
        $relatedProducts = [];

        foreach($cartItems as $cartItem){
            if(!isset($relatedProducts[$cartItem->id])){
                $relatedProducts[$cartItem->id] = $this->productRepository->byId($cartItem->id);
            }
        }
        
        return View::make('frontend_zz.cart',
            [
                'defaultData'=> $this->getDefaultCartFormData(),
                'items'=> $cartItems,
                'relatedProducts'=> $relatedProducts,
                'months'=> $months,
                'currentMonths'=> $currentMonths,
                'has_insurance'     => $this->cartContainsInsurance(),
                'is_recurring'     => $this->cartContainsRecurring(),
                'priceInitial'   => formatPrice($this->getTotalPriceInitial()),
                'priceFinal'   => $this->getTotalPriceFinal(),
                'recurringPrice'   => formatPrice($this->cartGetPriceRecurring()),
                'previousYears'=> $previousYears,
                'nextYears'=> $nextYears,
                'cards' => array(
                    'visa' => 'img/visa.png',
                    'mastercard' => 'img/mastercard.png',
                    'amex' => 'img/amex.png',
                    'jcb' => 'img/jcb.png',
                    'dinersclub' => 'img/dinersclub.png',
                    'discover' => 'img/discover.png'
                ),
            ]);
    }

    public function getPayment(){
        return View::make('frontend.payment_form');
    }

    public function getItems(){
        return $this->formatJson(STATUS_SUCCESS,
            [
                'items' =>  LaraCart::getItems(),
            ]
        );
    }

    public function getEmpty(){
        // Empty will only empty the contents
        LaraCart::emptyCart();
        return $this->formatJson(STATUS_SUCCESS);
    }

    public function getDestroy(){
        // Destroy will remove the entire instance of the cart including coupons / fees etc.
        LaraCart::destroyCart();
        return $this->formatJson(STATUS_SUCCESS);
    }

    public function getTotalPriceInitial(){
        return LaraCart::total($formatted = false, $withDiscount = true);
    }

    public function countCartItems(){
        return LaraCart::count($withItemQty = false);
    }

    public function postRemoveitem($itemHash = ''){
        $productsRelatedToCartItem = LaraCart::find(['related_to_cart_item' => $itemHash]);
        if(count($productsRelatedToCartItem)){
            foreach($productsRelatedToCartItem as $productRelated){
                LaraCart::removeItem($productRelated->itemHash);
            }
        }

        LaraCart::removeItem($itemHash);

        return $this->formatJson(STATUS_SUCCESS,[
            'items_count' => $this->countCartItems()
        ]);
    }

    public function postIncrementItem($itemHash = ''){

        $item = LaraCart::getItem($itemHash);
        if(!$item){
            return $this->formatJson();
        }

        if(!Input::has('increment')) {
            return redirect()->back()->with('fail', 'Please, try again later')->withInput();
        }

        if(Input::get('increment')){
            LaraCart::increment($itemHash);
        } else {
            LaraCart::decrement($itemHash);
        }

        // temporary
        //$item = LaraCart::getItem($itemHash);
        //$qty = ($item) ? $item->qty : 0;
        //return $this->formatJson(STATUS_SUCCESS,[ 'qty' => $qty ]);
        return redirect()->back()->with('success', 'Basket has been successfully updated')->withInput();
    }

    public function postUpdateItem($itemHash = '') {

        if( !Input::has('key') || !Input::has('value') ) return $this->formatJson();

        $item = LaraCart::getItem($itemHash);
        if(!$item){
            return $this->formatJson();
        }

        $item->options = array_merge($item->options, [Input::get('key') => Input::get('value')]);

        LaraCart::removeItem($itemHash);

        $newCartItem = LaraCart::add($item->id, $item->title, $item->qty, $item->price,
            $item->options,
            $item->taxable,
            $item->lineItem
        );

        if(!$newCartItem){
            return $this->formatJson();
        }

        return $this->formatJson(STATUS_SUCCESS,[
            'items_count' => $this->countCartItems()
        ]);
    }
}
