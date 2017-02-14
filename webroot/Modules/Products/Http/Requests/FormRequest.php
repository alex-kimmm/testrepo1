<?php

namespace TypiCMS\Modules\Products\Http\Requests;

use AdamWathan\Form\Elements\Input;
use App\Libraries\ZZUtils;
use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;
use TypiCMS\Modules\Products\Models\Product;

class FormRequest extends AbstractFormRequest
{
    private $maxFileSizeMB = 5 ;

    public function rules()
    {
        $image_rule = 'image|max:'. ZZUtils::convertMB2KB($this->maxFileSizeMB);
        $product_id = $this->input('id');
        $category_id = $this->input('category_id');
        $newCategorySupplied = false;
        $productHasImage = false;
        if($product_id) {
            $product = Product::find($product_id);
            if($product){
                if (!empty($product->image)) $productHasImage = true;
                $newCategorySupplied = ($product->category_id != $category_id);
            }

        }

        $rules = [
            'image'   => (($productHasImage)? '' : 'required|') . $image_rule,
            'product_photo.*'   => $image_rule,
            '*.title' => 'max:255',
            '*.slug'  => 'max:255',
            'price'   => 'required|numeric|between:0,99999999.99',
            'sku'     => 'required|alpha_dash|unique:products,sku' . (($product_id) ? ',' . $product_id : ''),
            'category_id'  => 'required|numeric|min:1|notRootCategory'. (($product_id && !$newCategorySupplied) ? '' : '|notInsuranceCategory'),
            'weight'            => 'numeric',
            'length'            => 'numeric',
            'width'             => 'numeric',
            'height'            => 'numeric'
        ];

        return $rules;
    }
}
