<?php

namespace App\Http\Requests;

use TypiCMS;
use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

abstract class ZZTypiCMSRequest extends AbstractFormRequest
{
    protected function sanitizeTransUrlForField($urlField)
    {
        $locales = TypiCMS::getOnlineLocales();
        $host = $this->server ("HTTP_HOST");

        foreach($locales as $lang){
            $langData = $this->input($lang);
            $uri = $this->input($lang.'.'.$urlField);
            $sanitizedURL = _sanitizeURL($uri,$host);



            if(!empty($sanitizedURL)){
                $langData[$urlField] = $sanitizedURL;
                $this->merge([
                    $lang => $langData,
                ]);
            }
        }

        return parent::getValidatorInstance();
    }
}
