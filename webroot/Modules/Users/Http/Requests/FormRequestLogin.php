<?php

namespace TypiCMS\Modules\Users\Http\Requests;

class FormRequestLogin extends AuthGeneralFormRequest
{
    public function rules()
    {
        return [
            'email'      => 'required|email|max:255',
            'password'   => 'required|max:255',
        ];
    }
}
