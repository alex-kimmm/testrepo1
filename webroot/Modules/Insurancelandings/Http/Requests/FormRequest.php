<?php

namespace TypiCMS\Modules\Insurancelandings\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'header_block_id'   => 'required',
            '*.title' => 'max:255',
            '*.slug'  => 'max:255',
        ];
    }
}
