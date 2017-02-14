<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CartFormRequest extends FormRequest
{
    public function rules()
    {

        $checkoutRules = [
            'deliveryFirstName'     => 'required',
            'deliveryEmail'         => 'sometimes|email',
            'deliveryPhone'         => 'required|ukPhoneNumber',
            'deliveryPostcode'      => 'required|ukPostCode|postCodeFromEU',
            'deliveryAddress1'      => 'required',
            'deliveryCity'          => 'required',

            'cardUserName'          => 'required|completeName',
            'cardStartMonth'        => 'required|integer|min:1|max:12',
            'cardStartYear'         => 'required|integer|creditCardValidStartYearMonth:'.$this->input('cardStartMonth'),
            'cardExpireMonth'       => 'required|integer|min:1|max:12',
            'cardExpireYear'        => 'required|integer|creditCardValidExpireYearMonth:'.$this->input('cardExpireMonth'),
            'cardCVV'               => 'required|creditCardValidCvc:'.$this->input('cardType'),
            'cardNumber'            => 'required|creditCardValidCreditCard:'.$this->input('cardType'),
            'cardType'              => 'required',

        ];

        if(!$this->input('billingAsDelivery')){
            $checkoutRules['billingFirstName']  = 'required';
            $checkoutRules['billingPhone']      = 'required|ukPhoneNumber';

            $checkoutRules['billingPostcode']  = 'required|ukPostCode|postCodeFromEU';
            $checkoutRules['billingAddress1']   = 'required';
            $checkoutRules['billingCity']      = 'required';
        }

        if(!Auth::check() && $this->input('cartAccountOptRadio') == CART_OPTION_ACCOUNT_CREATE_ACCOUNT){
            $checkoutRules['accountFirstName']  = 'required|max:255';
            $checkoutRules['accountLastName']   = 'required|max:255';
            $checkoutRules['accountEmail']      = 'required|email|max:255|unique:users,email';
            $checkoutRules['accountPassword']   = 'required|min:8|max:255|confirmed';
        } elseif(!Auth::check() && $this->input('cartAccountOptRadio') == CART_OPTION_ACCOUNT_LOGIN){
            $checkoutRules['loginEmail']  = 'required|email|max:255';
            $checkoutRules['loginPassword']   = 'required|max:255';
        }

        return $checkoutRules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
