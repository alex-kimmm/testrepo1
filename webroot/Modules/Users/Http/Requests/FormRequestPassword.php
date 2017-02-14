<?php

namespace TypiCMS\Modules\Users\Http\Requests;

class FormRequestPassword extends AuthGeneralFormRequest
{
    public function rules()
    {
        $rules = [
            'token'    => 'required',
//            'email'    => 'required|email|max:255',
            'password' => 'required|min:8|max:255|confirmed',
            'password_confirmation' => 'required',
        ];

        return $rules;
    }
}
