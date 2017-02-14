<?php

namespace TypiCMS\Modules\Users\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class AuthGeneralFormRequest extends AbstractFormRequest
{
    protected function getValidatorInstance() {
        //Sanitize email field
        if(!is_null($this->input('email'))){
            $this->merge([
                'email'    => mb_strtolower(trim($this->input('email'))) ,
            ]);
        }
        return parent::getValidatorInstance();
    }

}
