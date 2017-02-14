<?php
namespace TypiCMS\Modules\Landingpages\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest {

    public function rules() {

        $rules = [
            'header_block_id'   => 'required',
            '*.title'           => 'max:255',
            '*.slug'            => 'max:255'
        ];

        return $rules;
    }
}
