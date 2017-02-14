<?php

namespace TypiCMS\Modules\Headerblocks\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest {

    public function rules() {
        $rules = [
            'image'           => 'image|max:2000',
            'image_mobile'    => 'image|max:2000',
            'video'           => 'mimes:mp4|max:200000',
            'gradient_id'     => 'numeric',
            '*.title'         => 'max:255',
            '*.slug'          => 'max:255',
            '*.quote_text'    => 'max:255',
            '*.quote_subtext' => 'max:255'
        ];

        return $rules;
    }
}
