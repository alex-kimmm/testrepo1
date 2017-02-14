<?php

namespace TypiCMS\Modules\Homepageblocks\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest {

    public function rules() {
        $rules =  [
            'image'                    => 'image|max:2000',
            'block_background_image'   => 'image|max:2000',
            '*.title'                  => 'max:255',
            '*.subtitle'               => 'max:255',
            '*.slug'                   => 'max:255',
            'position'                 => 'required',
            'benefits_url'             => 'required'
        ];

        return $rules;
    }
}
