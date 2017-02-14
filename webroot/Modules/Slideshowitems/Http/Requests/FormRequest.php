<?php

namespace TypiCMS\Modules\Slideshowitems\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'image'   => 'image|max:2000',
            'video'   => 'mimes:mp4|max:200000',
            '*.title' => 'max:255',
            '*.slug'  => 'max:255',
            'hasNeither' => 'size:0',
            'hasBoth'    => 'size:0',
        ];
    }

    public function messages(){
        return [
            'hasNeither.size' => 'A page or a product is required.',
            'hasBoth.size'    => 'You cannot choose both a page and a product.'
        ];
    }

    protected function getValidatorInstance()
    {
        $product_id = $this->input('product_id');
        $page_id = $this->input('page_id');

        $this->merge([
            'hasBoth'    => !empty($product_id)  && !empty($page_id),
            'hasNeither' => empty($product_id) && empty($page_id)
        ]);

        return parent::getValidatorInstance();
    }
}
