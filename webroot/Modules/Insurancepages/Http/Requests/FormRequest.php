<?php

namespace TypiCMS\Modules\Insurancepages\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;
use TypiCMS\Modules\Insurancepages\Models\Insurancepage;

class FormRequest extends AbstractFormRequest {

    public function rules() {
        $rules = [
            'image'        => 'image|max:2000',
            'video'        => 'mimes:mp4|max:200000',
            '*.title'      => 'max:255',
            '*.slug'       => 'max:255',
            '*.subtitle'   => 'max:255',
            '*.menu_title' => 'max:255',
            'hasBoth'      => 'size:0',
            'category_id'  => 'numeric',
            'gradient_id'  => 'numeric',
        ];

        return $rules;
    }

    public function messages(){
        return [
            'hasBoth.size' => 'You can not have a duplicate step for the same category!'
        ];
    }

    protected function getValidatorInstance() {
        $hasStep = false;
        $step = Insurancepage::where('step', $this->get('step'))->where('category_id', $this->get('category_id'))->first();

        if((!empty($step) && $this->get('id') != "") || (!empty($step) && $this->get('id') == "")) {
            $hasStep = $step->id != $this->get('id');
        }

        $this->merge([
            'hasBoth' => $hasStep
        ]);

        return parent::getValidatorInstance();
    }
}
