<?php

namespace TypiCMS\Modules\Users\Http\Requests;

class FormRequest extends AuthGeneralFormRequest
{
    public function rules()
    {
        $rules = [
            'email'      => 'required|email|max:255|unique:users,email,'.$this->id,
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'password'   => 'required|min:8|max:255|confirmed',
            'password_confirmation' => 'required',
        ];

        return $rules;
    }
}
