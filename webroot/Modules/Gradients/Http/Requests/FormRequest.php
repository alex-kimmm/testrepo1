<?php

namespace TypiCMS\Modules\Gradients\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            '*.title' => 'max:255',
        ];
    }
}
