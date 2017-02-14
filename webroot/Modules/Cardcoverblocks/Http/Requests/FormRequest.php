<?php

namespace TypiCMS\Modules\Cardcoverblocks\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'image'           => 'image|max:2000',
            '*.title'         => 'max:255',
            '*.slug'          => 'max:255',
            'button_title'    => 'required|max:255',
            'button_link'     => 'max:255',
        ];
    }
}
