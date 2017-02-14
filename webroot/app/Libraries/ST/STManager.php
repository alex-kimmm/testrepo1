<?php
/**
 * Created by PhpStorm.
 * User: energy
 * Date: 4/14/16
 * Time: 11:46
 */

namespace App\Libraries\ST;

use Illuminate\Support\Facades\View;

class STManager {

    private $data;
    private $isRecurringPayment;
    private $threeTransactionReference;


    /**
     * @param $data array
     */
    public function __construct($data = null) {
        $this->isRecurringPayment = $data['billing']['is_recurring'];
        $this->data = $data;
    }


    public function setData($data) {
        $this->data = $data;
    }


    public function tryPayment() {
        $stGateway = new STGateway();
        $stGateway->init(env('ST_HOST'), env('ST_PORT'));
        $stGateway->setSiteReference(env('ST_ALIAS'));
        $stGateway->setUsername(env('ST_ALIAS'));

        $req = [
            'customer' => [
                'town' => $this->data['customer']['town'],
                'name' => [
                    'middle' => $this->data['customer']['name']['middle'],
                    'prefix' => $this->data['customer']['name']['prefix'],
                    'last'   => $this->data['customer']['name']['last'],
                    'first'  => $this->data['customer']['name']['first']
                ],
                'ip' => $this->data['customer']['ip'],
                'telephone' => [
                    '@value' => $this->data['customer']['telephone'],
                    '@attributes' => [
                        'type' => 'H'
                    ]
                ],
                'street' => $this->data['customer']['street'],
                'postcode' => $this->data['customer']['postcode'],
                'premise' => $this->data['customer']['premise']
            ],
            'amount'          => $this->data['billing']['price_fixed'],
            'currency'        => $this->data['currency'],
            'card' => [
                'number'      => $this->data['card']['number'],
                'expiryMonth' => $this->data['card']['expiryMonth'],
                'expiryYear'  => $this->data['card']['expiryYear'],
                'cvv'         => $this->data['card']['cvv'],
                'firstName'   => $this->data['card']['firstName'],
                'lastName'    => $this->data['card']['lastName'],
            ],
            'operation' => [
                'authmethod' => 'FINAL',
                'sitereference' => env('ST_ALIAS'),
<<<<<<< HEAD
                'accounttypedescription' => env('PAYMENT_TYPE', 'ECOM')
=======
                'accounttypedescription' => PAYMENT_TYPE
>>>>>>> test
            ]
        ];

        if($this->threeTransactionReference) {
            $req['operation']['parenttransactionreference'] = $this->threeTransactionReference;
        }

        $request1 = $stGateway->purchase($req);
<<<<<<< HEAD
        $request1->setTransactionId( env('PAYMENT_TYPE', 'ECOM') . '-' . rand(1000,9999) . time());

        try {

//            file_put_contents(public_path() . '/temp/31_payment.xml', $request1->getData()->asXML());

=======
        $request1->setTransactionId(PAYMENT_TYPE . '-' . rand(1000,9999) . time());

        try {

>>>>>>> test
            $response = $stGateway->send($request1->getData()->asXML());
            $response = new STResponse($request1, $response);

//            file_put_contents(public_path() . '/temp/41_payment_response.json', json_encode($response->getParsedArray()));

            return [
<<<<<<< HEAD
                'success' => ($response->getRealCode() === 0) ? true : false,
=======
                'success' => ($response->getCode() == 0) ? true : false,
>>>>>>> test
                'response' => $response->getParsedArray(),
                'message' => $response->getRealMessage()
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'response' => $e->getMessage(),
                'message' => "Cannot process payment."
            ];
        }
    }


    public function tryRecurringPayment() {

        $unique = rand(1000,9999) . time();

        $stGateway = new STGateway();
        $stGateway->init(env('ST_HOST'), env('ST_PORT'));
        $stGateway->setSiteReference(env('ST_ALIAS'));
        $stGateway->setUsername(env('ST_ALIAS'));

        $req = [
            'customer' => [
                'town' => $this->data['customer']['town'],
                'name' => [
                    'middle' => $this->data['customer']['name']['middle'],
                    'prefix' => $this->data['customer']['name']['prefix'],
                    'last' => $this->data['customer']['name']['last'],
                    'first' => $this->data['customer']['name']['first']
                ],
                'ip' => $this->data['customer']['ip'],
                'telephone' => [
                    '@value' => $this->data['customer']['telephone'],
                    '@attributes' => [
                        'type' => 'H'
                    ]
                ],
                'street' => $this->data['customer']['street'],
                'postcode' => $this->data['customer']['postcode'],
                'premise' => $this->data['customer']['premise']
            ],
            'amount'          => $this->data['billing']['price_fixed'],
            'currency'        => $this->data['currency'],
            'card' => [
                'number'      => $this->data['card']['number'],
                'expiryMonth' => $this->data['card']['expiryMonth'],
                'expiryYear'  => $this->data['card']['expiryYear'],
                'cvv'         => $this->data['card']['cvv'],
                'firstName'   => $this->data['card']['firstName'],
                'lastName'    => $this->data['card']['lastName'],
            ],
            'subscription' => [
                'number' => '1',

            ],
            'operation' => [
                'authmethod' => 'FINAL',
                'sitereference' => env('ST_ALIAS'),
<<<<<<< HEAD
                'accounttypedescription' =>  env('PAYMENT_TYPE', 'ECOM')
=======
                'accounttypedescription' => PAYMENT_TYPE
>>>>>>> test
            ]
        ];

        if($this->threeTransactionReference) {
            $req['operation']['parenttransactionreference'] = $this->threeTransactionReference;
        }

        $request1 = $stGateway->purchase($req);
<<<<<<< HEAD
        $request1->setTransactionId( env('PAYMENT_TYPE', 'ECOM') . "-" . $unique);
=======
        $request1->setTransactionId(PAYMENT_TYPE . "-" . $unique);
>>>>>>> test

        $request2 = $stGateway->purchaseRecurring([
            'amount'          => $this->data['billing']['price_recurring'],
            'currency'        => $this->data['currency'],
            'card' => [
                'number'      => $this->data['card']['number'],
                'expiryMonth' => $this->data['card']['expiryMonth'],
                'expiryYear'  => $this->data['card']['expiryYear'],
                'cvv'         => $this->data['card']['cvv'],
                'firstName'   => $this->data['card']['firstName'],
                'lastName'    => $this->data['card']['lastName'],
            ],
            'subscription' => [
                'unit' => PAYMENT_RECUR_UNIT,
                'frequency' => '1',
                'finalnumber' => PAYMENT_RECUR_FINAL + 1,
                'number' => '2',

            ],
            'operation' => [
                'sitereference' => env('ST_ALIAS'),
                'accounttypedescription' => 'RECUR'
            ]
        ]);
        $request2->setTransactionId("RECUR-" . $unique);

//        file_put_contents(public_path() . '/temp/32_payment_recurring.xml', $request1->getData()->asXML());
//        file_put_contents(public_path() . '/temp/33_payment_recurring.xml', $request2->getData()->asXML());

        try {
            $data = $stGateway->combinePurchaseRequests([$request1, $request2 ]);
            $response = $stGateway->send($data);
            $response = new STResponse($request1, $response);

//            file_put_contents(public_path() . '/temp/42_payment_recurring_response.json', json_encode($response->getParsedArray()));

            return [
<<<<<<< HEAD
                'success' => ($response->getRealCode() === 0) ? true : false,
=======
                'success' => ($response->getCode() == 0) ? true : false,
>>>>>>> test
                'response' => $response->getParsedArray(),
                'message' => $response->getRealMessage()
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'response' => $e->getMessage(),
                'message' => "Cannot process payment."
            ];
        }
    }


    // first check if 3d secure and go ahead

    public function initPayment() {

        $stGateway = new STGateway();
        $stGateway->init(env('ST_HOST'), env('ST_PORT'));
        $stGateway->setSiteReference(env('ST_ALIAS'));
        $stGateway->setUsername(env('ST_ALIAS'));
        $stGateway->setApplyThreeDSecure(true);

        $request1 = $stGateway->threeDSecure([
            'merchant' => [
                'orderreference' => 'THREED-CHECK-ORDER-REF-' . rand(1000,9999) . time()
            ],
            'customer' => [
                'useragent' => $_SERVER['HTTP_USER_AGENT'],
                'accept' => 'text/html,*/*',
                'name' => [
                    'last'  => $this->data['customer']['name']['last'],
                    'first' => $this->data['customer']['name']['first']
                ]
            ],
            'returnUrl'       => env('THREE_D_SECURE_RETURN_URL'),
            'amount'          => $this->data['billing']['price_fixed'],
            'currency'        => $this->data['currency'],
            'card'            => [
                'number'      => $this->data['card']['number'],
                'expiryMonth' => $this->data['card']['expiryMonth'],
                'expiryYear'  => $this->data['card']['expiryYear'],
                'cvv'         => $this->data['card']['cvv'],
                'firstName'   => $this->data['card']['firstName'],
                'lastName'    => $this->data['card']['lastName'],
            ],
            'postcode' => $this->data['customer']['postcode'],
            'premise' => $this->data['customer']['premise'],
            'operation' => [
                'sitereference' => env('ST_ALIAS'),
<<<<<<< HEAD
                'accounttypedescription' => env('PAYMENT_TYPE', 'ECOM'),
=======
                'accounttypedescription' => PAYMENT_TYPE,
>>>>>>> test
                'authmethod' => 'FINAL'
            ]
        ]);

        $request1->setTransactionId('THREED-CHECK-' . rand(1000,9999) . time());

        try {

//            file_put_contents(public_path() . '/temp/1_3dsecure.xml', $request1->getData()->asXML());

            $response = $stGateway->send($request1->getData()->asXML());
            $response = new STResponse($request1, $response);

//            file_put_contents(public_path() . '/temp/2_3dsecure_response.json', json_encode($response->getParsedArray()));

            $response = $response->getParsedArray();

            $threeDSecureData = $response->response->threedsecure;

            // if card enrolled in 3D Secure System

            if((string) $threeDSecureData->enrolled == "Y") {

                // make post to ACS (Access Control Server)
                // and Waiting for the customer to return from the ACS to TermUrl as callback

                $acsurl = (string) $threeDSecureData->acsurl;
                $pareq = (string) $threeDSecureData->pareq;
                $termurl = env('THREE_D_SECURE_RETURN_URL');
                $md = (string) $threeDSecureData->md;

                return [
                    'success' => true,
                    'response' => View::make('acs_redirect', compact('acsurl', 'pareq', 'termurl', 'md')),
                    'is_three_d_secure' => true,
                    'message' => ""
                ];

            }

            // not enrolled in 3D Secure System

            else {
                // action : go ahead without 3d secure
                // make simple AUTH (or AUTH + SUBSCRIPTION) xml call
                // with some new parameters, see 5.1.2 http://www.securetrading.com/files/documentation/STPP-3D-Secure.pdf
                // parameters from first transaction of this flow

                $this->threeTransactionReference = (string) $response->response->transactionreference;

                if($this->isRecurringPayment) {
                    $payment = $this->tryRecurringPayment();
                }
                else {
                    $payment = $this->tryPayment();
                }

                return [
                    'success' => $payment['success'],
                    'response' => $payment['response'],
                    'message' => $payment['message']
                ];
            }

        } catch (\Exception $e) {
            return [
                'success' => false,
                'response' => $e->getMessage(),
                'message' => "Cannot process payment."
            ];
        }
    }
}
