<?php

namespace TypiCMS\Modules\Insuranceblocks\Http\Requests;

use App\Libraries\ZZUtils;
use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;
use TypiCMS\Modules\Insuranceblocks\Models\InsuranceblockFile;

class FormRequest extends AbstractFormRequest {

    public function rules() {

        $files = '';
        if($this->get('files') != null && $this->has('files')) {
            $files = 'max:'. (ZZUtils::convertMB2KB(InsuranceblockFile::$MAX_FILE_SIZE_IN_MB)) .'|mimes:' . InsuranceblockFile::$insurance_block_rules_valid_files_extensions;
        }

        $rules = [
            'image'                                => 'image|max:2000',
            'image_mobile'                         => 'image|max:2000',
            '*.title'                              => 'max:255',
            '*.slug'                               => 'max:255',
            'position'                             => 'required',
            //config('app.locale') . '.button_title' => 'required',
            'files.*'                              => $files
        ];

        return $rules;
    }
}
