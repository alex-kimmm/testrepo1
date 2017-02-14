<?php

namespace TypiCMS\Modules\Users\Http\Requests;

class FormRequestRegister extends AuthGeneralFormRequest
{
    public function rules()
    {
        $rules = [
            'email'                 => 'required|email|max:255|unique:users',
            'first_name'            => 'required|max:255',
            'last_name'             => 'required|max:255',
            'password'              => 'required|min:8|max:255|confirmed',
            'password_confirmation' => 'required',
        ];

        return $rules;
    }

    public function messages(){
        return [
            'email.unique' => 'This email address already corresponds to a ZugarZnap Account. Please sign in or, if you forgot your password, reset it.',
        ];
    }
}
