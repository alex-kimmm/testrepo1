<?php

namespace TypiCMS\Modules\Cards\Http\Requests;

use App\Http\Requests\ZZTypiCMSRequest;
use TypiCMS;

class FormRequest extends ZZTypiCMSRequest
{
    public function rules()
    {
        $hasImage = (
            $this->input('id') &&
            ($card = TypiCMS\Modules\Cards\Models\Card::find($this->input('id'))) &&
            !is_null($card)  &&
            !empty($card->image)
        );

        return [
            'image'   => (($hasImage)? '' : 'required|') . 'image|max:2000',
            '*.title' => 'max:255',
            '*.slug'  => 'max:255',
            'gradient_id'  => 'numeric|not_in:0',
        ];
    }

    protected function getValidatorInstance() {
        $this->sanitizeTransUrlForField('redirect_link');
        return parent::getValidatorInstance();
    }

}
