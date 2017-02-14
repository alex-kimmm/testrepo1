<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use TypiCMS\Modules\Products\Models\Product;

class InsuranceFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'product_id'            => 'required|numeric',
            'postcode'              => 'required|ukPostCode|postCodeFromEU',
            'attributeOptionID'     => 'required|numeric',
            'firstname'             => 'required',
            'lastname'              => 'required',
            'email'                 => 'required|email',
            'town'                  => 'required',
            'address1'              => 'required',
            'tempinceptiondate'     => 'required|date_format:"d/m/Y"|after:tomorrow', //tomorrow date is a valid one
            'accept_terms'          => 'required',
            'telno'                 => 'required|ukPhoneNumber'
        ];

        //TO DO

        $product_id = $this->input('product_id');
        $product = Product::find($product_id);
        if($product && $product->category_id == CATEGORY_XS_COVER){
            $rules['car'] = 'required';
        }

        return $rules;
    }
}
