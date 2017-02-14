<?php

namespace TypiCMS\Modules\Musiccards\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;
use TypiCMS\Modules\Musiccards\Models\Musiccard;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        $hasImage = (
            $this->input('id') &&
            ($card = Musiccard::find($this->input('id'))) &&
            !is_null($card)  &&
            !empty($card->image)
        );

        return [
            'image'   => (($hasImage)? '' : 'required|') . 'image|max:2000',
            config('app.locale').'.title' => 'required|max:255',
            config('app.locale').'.summary' => 'required',
            config('app.locale').'.song_name'  => 'required|max:255',
            '*.slug'  => 'max:255',
        ];
    }
}
