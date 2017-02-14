<?php

namespace App\Http\Controllers;

use App\Http\IWEPApiController;
use App\Libraries\ST\STManager;
use App\Services\MailService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use LukePOLO\LaraCart\Facades\LaraCart;
use TypiCMS\Modules\Orders\Models\OrderPayment;
use TypiCMS\Modules\Orders\Repositories\OrderInterface;


class PaymentsController extends Controller {

    private $orderRepository;

    public function __construct(OrderInterface $orderInterface) {
        $this->orderRepository = $orderInterface;
    }

    public function getCheckout() {

        // data from order
        $order_data = Session::pull('payData');

        if(!isset($order_data['order_id'])) {
            die('Please provide data');
        }

        $details = [

            'customer' => [

                'name' => [
                    'middle' => $this->getSafeValue($order_data, 'middle'),
                    'prefix' => $this->getSafeValue($order_data, 'prefix'),
                    'last'   => $this->getSafeValue($order_data, 'last'),
                    'first'  => $this->getSafeValue($order_data, 'first')
                ],

                'ip' => $_SERVER['REMOTE_ADDR'],
                'telephone' => $this->getSafeValue($order_data, 'telephone'),
                'town' => $this->getSafeValue($order_data, 'town'),
                'street'   => $this->getSafeValue($order_data, 'street'),
                'postcode' => $this->getSafeValue($order_data, 'postcode'),
                'premise'  => $this->getSafeValue($order_data, 'premise')
            ],

            'card' => [
                'number'      => $this->getSafeValue($order_data, 'number'),
                'expiryMonth' => $this->getSafeValue($order_data, 'expiryMonth'),
                'expiryYear'  => $this->getSafeValue($order_data, 'expiryYear'),
                'cvv'         => $this->getSafeValue($order_data, 'cvv'),
                'firstName'   => $this->getSafeValue($order_data, 'firstName'),
                'lastName'    => $this->getSafeValue($order_data, 'lastName'),
            ],

            'currency' => $this->getSafeValue($order_data, 'currency'), //GBP
            'billing' => [
                'order_id' => $this->getSafeValue($order_data, 'order_id'),
                'price_fixed' => $this->getSafeValue($order_data, 'price_fixed'), // decimal ex: 11.00
                'price_recurring' => $this->getSafeValue($order_data, 'price_recurring'), // decimal ex: 1.00
                'is_recurring' => $this->getSafeValue($order_data, 'price_recurring') != ''
            ]
        ];

        Session::put('cart_details', $details);

        $stManager = new STManager($details);
        $data = $stManager->initPayment();

        if($data['success'] && isset($data['is_three_d_secure'])) {
            // redirect to ACS
            return $data['response'];
        }

        elseif($data['success']) {
            $this->insertOrderPayment($details['billing']['order_id'], $data['success'], $data['response']);
            return $this->success($details['billing']['order_id'], $data['response'], $data['message']);
        }

        else {
            $this->insertOrderPayment($details['billing']['order_id'], $data['success'], $data['response']);
            return $this->fail($details['billing']['order_id'], $data['response'], $data['message']);
        }
    }


    // callback from 3d secure

    public function postThreeProcessed() {

        // make simple AUTH (or AUTH + SUBSCRIPTION) xml call
        // with some new parameters, see 5.1.1 http://www.securetrading.com/files/documentation/STPP-3D-Secure.pdf

        $data = Input::all();

        // data from order
        $details = Session::pull('cart_details');
        $isRecurring = $details['billing']['is_recurring'];

        if($details == null) {
            die('Forbidden <a href="/">Back</a>');
        }

        // add new fields to array

        $details['threedsecure'] = [
            'pares' => $data['PaRes'],
            'md' => $data['MD']
        ];

        $stManager = new STManager($details);

//        file_put_contents(public_path() . '/temp/21_3dsecure_response_acs.json', json_encode($data));

        if($isRecurring) {
            $data = $stManager->tryRecurringPayment();
        }
        else {
            $data = $stManager->tryPayment();
        }

        $this->insertOrderPayment($details['billing']['order_id'], $data['success'], $data['response']);

        if($data['success']) {
            return $this->success($details['billing']['order_id'], $data['response'], $data['message']);
        }

        else {
            return $this->fail($details['billing']['order_id'], $data['response'], $data['message']);
        }
    }

    private function getTransactionreferenceFromResponse($data){
        return isset($data->response->transactionreference) ? (string)$data->response->transactionreference : 'Unknown';
    }

    private function insertOrderPayment($order_id, $status, $data) {
        OrderPayment::create([
            'order_id' => $order_id,
            'success'  => $status,
            'payment'  => json_encode($data)
        ]);

        $this->orderRepository->update([
            'id' => $order_id,
            'transaction_id' => $this->getTransactionreferenceFromResponse($data),
            'payment_status' => $status ? 'Paid' : 'Fail',
            'paid' => $status,
            'ref_number' => rand(10, 99) . $order_id . time()
        ]);
    }

    private function success($order_id, $response, $message = "") {

        $orderObj = $this->orderRepository->byId($order_id);

        $authUser = Auth::user();

        $orderInsuranceTransactions = [];
        $orderInsuranceTransactionData = Session::pull('order_insurance_transaction_data');
        if($orderInsuranceTransactionData && isset($orderInsuranceTransactionData[$order_id])){
            $orderInsuranceTransactions = $orderInsuranceTransactionData[$order_id];
        }

        if(count($orderInsuranceTransactions)>0){

            $order_data = [
                'transaction_id' => $orderObj->transaction_id,
                'ref_number' => $orderObj->ref_number,
                'remote_order_id' => $order_id,
//                'options' => $orderObj->options,
            ];

            foreach($orderInsuranceTransactions as $orderInsuranceTransaction){
                try {
                    //Set status set as paid on IWEP

                    $order_data['policy_data'] = $orderInsuranceTransaction->insuranceItem->options;

                    $policy = IWEPApiController::getInstance()->successFinishTransaction($orderInsuranceTransaction->policy_id,
                        [
                            'transaction_id'    => $orderInsuranceTransaction->id,
                            'paymentID'         => $this->getTransactionreferenceFromResponse($response),
                            'datePaid'          => Carbon::now()->format('Y-m-d'),
                            'inceptiondate'     => $orderInsuranceTransaction->zz_inception_date,
                            'remote_order_id'   => $order_id,
                            'order_data'        => \GuzzleHttp\json_encode($order_data),
                        ]
                    );

                    if(isset( $policy->pdf_documents )) {
                        $contentData = [
                            'subject' => 'Order Policy Documents',
                            'pdf_documents' => $policy->pdf_documents
                        ];
                        MailService::sendMailUserOrderDocs($authUser, $contentData);
                    }

                } catch(\Exception $e){

                }
            }
        }

        $contentData = [
            'subject' => 'Order Acknowledgment',
            'order' => $orderObj
        ];
        MailService::sendMailUserOrder($authUser, $contentData);

        // check insurance type

        foreach($orderObj->products as $p) {
            if($p->isInsurance() && $p->isGadgetInsurance()) {
                MailService::sendMailUserOrderInsuranceInfo($authUser, CATEGORY_GADGET_INSURANCE, $orderObj);
                break;
            }

            if($p->isInsurance() && $p->isXSCover()) {
                MailService::sendMailUserOrderInsuranceInfo($authUser, CATEGORY_XS_COVER, $orderObj);
                break;
            }
        }

        LaraCart::destroyCart();

        return View::make('frontend_zz.payment_response', [
            'success' => true,
            'message' => 'Your payment has been placed successfully.',
            'data' => $response,
            'order' => $orderObj
        ]);
    }

    private function fail($order_id, $response, $message = "") {

        $orderInsuranceTransactions = [];
        $orderInsuranceTransactionData = Session::pull('order_insurance_transaction_data');
        if($orderInsuranceTransactionData && isset($orderInsuranceTransactionData[$order_id])){
            $orderInsuranceTransactions = $orderInsuranceTransactionData[$order_id];
        }

        if(count($orderInsuranceTransactions)>0){
            foreach($orderInsuranceTransactions as $orderInsuranceTransaction){
                try {
                    //Set transaction as failed on IWEP
                    IWEPApiController::getInstance()->failFinishTransaction($orderInsuranceTransaction->policy_id, $orderInsuranceTransaction->id);
                } catch(\Exception $e){

                }
            }
        }

        return View::make('frontend_zz.payment_response', [
            'error' => true,
<<<<<<< HEAD
            'message' => 'There has been an error with your order. Please try again later.<br>Transaction status: ' . $message,
=======
            'message' => 'There has been an error with your order. Please try again later.<br>' . $message,
>>>>>>> test
            'order' => $this->orderRepository->byId($order_id)
        ]);
    }

}
