<?php

namespace TypiCMS\Modules\Quotes\Http\Requests;

use App\Http\Requests\ZZTypiCMSRequest;
use TypiCMS;

class FormRequest extends ZZTypiCMSRequest
{
    public function rules()
    {
        return [
            'image'   => 'image|max:2000',
            '*.title' => 'max:255',
            '*.slug'  => 'max:255',
            config('app.locale') . '.uri'  => 'required|max:255',
            'position' => 'required'
        ];
    }

    protected function getValidatorInstance()
    {
        $this->sanitizeTransUrlForField('uri');
        return parent::getValidatorInstance();
    }

}
