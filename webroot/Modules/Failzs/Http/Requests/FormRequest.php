<?php

namespace TypiCMS\Modules\Failzs\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            '*.title' => 'max:255',
            '*.slug'  => 'max:255',
            'obj_link'  => 'required',
        ];
    }
}
