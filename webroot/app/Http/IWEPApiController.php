<?php
/**
 * Created by PhpStorm.
 * User: Constantin
 * Date: 07/04/16
 * Time: 17:20
 */

namespace App\Http;

use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Auth;
use TypiCMS\Modules\Products\Models\Product;

class IWEPApiController {

    private $accessToken;
    private $apiClient;

    protected static $instance = null;

    protected function __construct()
    {
        //Thou shalt not construct that which is unconstructable!
        $this->apiClient = new \GuzzleHttp\Client();
    }

    private function getAuthUser(){
        return Auth::user();
    }

    protected function __clone()
    {
        //Me not like clones! Me smash clones!
    }

    private static $iwepCategoryImages = [];
    private static $relatedProducts = [];

    private static $IWEPCategoryMapping = [
        IWEP_CATEGORY_GADGET_INSURANCE  =>  CATEGORY_GADGET_INSURANCE,
        IWEP_CATEGORY_XS_COVER          =>  CATEGORY_XS_COVER,
    ];

    public static function getIWEPCategoryMapping(){
        return self::$IWEPCategoryMapping;
    }

    public static function getMappingCategoryFor($iwepCategory){
        return self::$IWEPCategoryMapping[$iwepCategory];
    }

    public static function getRelatedProduct($IWEPCategory){
        if(!isset(self::$relatedProducts[$IWEPCategory])){
            $product = Product::where('category_id',self::getMappingCategoryFor($IWEPCategory))->first();
            if($product){
                self::$relatedProducts[$IWEPCategory] = $product;
            }
        }
        return (isset(self::$relatedProducts[$IWEPCategory]))? self::$relatedProducts[$IWEPCategory] : null;


    }

    public static function getImageForIWEPCategory($IWEPCategory){
        if(!isset(self::$iwepCategoryImages[$IWEPCategory])){
            $product = self::getRelatedProduct($IWEPCategory);
            if($product){
                self::$iwepCategoryImages[$IWEPCategory] = $product->getImageUrl();
            }
        }
        return (isset(self::$iwepCategoryImages[$IWEPCategory]))? self::$iwepCategoryImages[$IWEPCategory] : '';
    }

    /**
     *
     * @return IWEPApiController
     */
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    private function getApiLink($method,$accessToken = false){
        $accessTokenGetParam = ($accessToken)? '?access_token='.$accessToken : '';
        return env('IWEP_API_LINK') . $method . $accessTokenGetParam;
    }

    private function getApiLinkTokened($method){
        if( is_null($this->accessToken) ){
            $this->apiAuthenticate();
        }
        return $this->getApiLink($method, $this->accessToken);
    }

    private function getExceptionFrom(BadResponseException $e){
        $data = \GuzzleHttp\json_decode($e->getResponse()->getBody(),true);

        $errMsg = '';
        if(isset($data['status']['message']) && is_array($data['status']['message'])){
            foreach($data['status']['message'] as $key => $apiErrMsg) {
                $errMsg .= $apiErrMsg . '</br>';
            }
        } elseif(isset($data['status']['message']) && is_string($data['status']['message'])) {
            $errMsg = $data['status']['message'];
        } else {
            $errMsg = 'An unexpected error has occurred.';
        }

        return new \Exception($errMsg, $e->getCode());
    }

    private function throwErrorIfNoUser(){
        if( is_null($this->getAuthUser())){
            throw new \Exception('Unauthorized',401);
        }
    }

    public function apiAuthenticate(){

        try {
            $response = $this->apiClient->request('POST', $this->getApiLink('oauth/token'), [
                'auth' => [
                    env('IWEP_CLIENT_ID'),
                    env('IWEP_CLIENT_SECRET'),
                ],
                "form_params" => [
                    'grant_type' => 'client_credentials',
                ]
            ]);

            $data = \GuzzleHttp\json_decode($response->getBody());
            $this->accessToken = $data->access_token;
        }

        catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }

    }

    public function getProducts()
    {
        try {
            $response = $this->apiClient->request('GET', $this->getApiLinkTokened('products'));

            $data = \GuzzleHttp\json_decode($response->getBody());
            if ($data->status->code == 'success') {
                return $data->data;
            }

        } catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }

        return [];
    }

    public function getProduct($productId)
    {
        try {
            $response = $this->apiClient->request('GET', $this->getApiLinkTokened('products/'.$productId));

            $data = \GuzzleHttp\json_decode($response->getBody());
            if ($data->status->code == 'success') {
                return $data->data;
            }

        } catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }

        return [];
    }

    public function createPolicy($detailsData){
        $this->throwErrorIfNoUser();

        try {

            $response = $this->apiClient->request('POST', $this->getApiLinkTokened('policies/'. $this->getAuthUser()->id .'/create'),[
                "form_params" => $detailsData,
            ]);

            $data = \GuzzleHttp\json_decode($response->getBody());
            if ($data->status->code == 'success') {
                return $data->data;
            }

        } catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }
    }

    public function updatePolicy($policyId,$form_params){

        $this->throwErrorIfNoUser();

        try {
            $response = $this->apiClient->request('POST', $this->getApiLinkTokened('policies/'. $this->getAuthUser()->id .'/edit/'.$policyId),[
                "form_params" => $form_params,
            ]);

            $data = \GuzzleHttp\json_decode($response->getBody());
            if ($data->status->code == 'success') {
                return $data->data;
            }

        } catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }
    }

    public function mtaPolicy($policyId,$form_params){

        $this->throwErrorIfNoUser();

        try {
            $response = $this->apiClient->request('POST', $this->getApiLinkTokened('policies/'. $this->getAuthUser()->id .'/mta/'.$policyId),[
                "form_params" => $form_params,
            ]);

            $data = \GuzzleHttp\json_decode($response->getBody());
            if ($data->status->code == 'success') {
                return $data->data;
            }

        } catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }
    }

    public function cancelPolicy($policyId){

        $this->throwErrorIfNoUser();

        try {
            $response = $this->apiClient->request('GET', $this->getApiLinkTokened('policies/'. $this->getAuthUser()->id .'/cancel/'.$policyId));

            $data = \GuzzleHttp\json_decode($response->getBody());

            if ($data->status->code == 'success') {
                return $data->data;
            }

        } catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }

        return;

    }

    public function deletePolicy($policyId){

        $this->throwErrorIfNoUser();

        try {
            $response = $this->apiClient->request('GET', $this->getApiLinkTokened('policies/'. $this->getAuthUser()->id .'/delete/'.$policyId));

            $data = \GuzzleHttp\json_decode($response->getBody());

            if ($data->status->code == 'success') {
                return $data->data;
            }

        } catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }

        return;
    }

    public function getPolicy($policyId){

        $this->throwErrorIfNoUser();

        try {
            $response = $this->apiClient->request('GET', $this->getApiLinkTokened('policies/'. $this->getAuthUser()->id .'/view/'.$policyId));

            $data = \GuzzleHttp\json_decode($response->getBody());

            if ($data->status->code == 'success') {
                return $data->data;
            }

        } catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }

        return;
    }

    public function getAllPolicies(){

        $this->throwErrorIfNoUser();

        try {
            $response = $this->apiClient->request('GET', $this->getApiLinkTokened('policies/'. $this->getAuthUser()->id .'/all'));

            $data = \GuzzleHttp\json_decode($response->getBody());

            if ($data->status->code == 'success') {
                return $data->data;
            }

        } catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }

        return [];
    }


    public function startTransaction($policyId){

        $this->throwErrorIfNoUser();

        try {
            $response = $this->apiClient->request('GET', $this->getApiLinkTokened('policies/'. $this->getAuthUser()->id .'/starttransaction/'. $policyId .'/'));

            $data = \GuzzleHttp\json_decode($response->getBody());

            if ($data->status->code == 'success') {
                return $data->data;
            }

        } catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }

        return;
    }

    public function successFinishTransaction($policyId, $transactionData = []){

        $this->throwErrorIfNoUser();

        try {
            $response = $this->apiClient->request('POST', $this->getApiLinkTokened('policies/'. $this->getAuthUser()->id .'/successtransaction/' . $policyId), [

                "form_params" => $transactionData,
            ]);

            $data = \GuzzleHttp\json_decode($response->getBody());

            if ($data->status->code == 'success') {
                return $data->data;
            }

        } catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }

        return;
    }

    public function failFinishTransaction($policyId, $transactionId){

        $this->throwErrorIfNoUser();

        try {
            $response = $this->apiClient->request('POST', $this->getApiLinkTokened('policies/'. $this->getAuthUser()->id .'/failtransaction/' . $policyId), [
                "form_params" => [
                    'transaction_id'    => $transactionId,
                ]
            ]);

            $data = \GuzzleHttp\json_decode($response->getBody());

            if ($data->status->code == 'success') {
                return $data->data;
            }

        } catch (BadResponseException $e) {
            throw $this->getExceptionFrom($e);
        }

        return;
    }


} 