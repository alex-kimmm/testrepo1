<?php

namespace TypiCMS\Modules\Users\Http\Requests;

class FormRequestEmail extends AuthGeneralFormRequest
{
    public function rules()
    {
        $rules = [
            'email' => 'required|email|max:255',
        ];

        return $rules;
    }
}
