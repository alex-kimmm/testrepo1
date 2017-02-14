@section('js')
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.image'), 'field_name' => 'image' ])

@include('core::admin._video-fieldset', ['field' => 'video'])

@include('core::form._title-and-slug')

{!! TranslatableBootForm::hidden('status')->value(0) !!}

{!! BootForm::text(trans('validation.attributes.subtitle'), 'subtitle') !!}

{!! BootForm::text(trans('validation.attributes.menu_title'), 'menu_title') !!}

{!! BootForm::select(trans('validation.attributes.step'), 'step', $model->steps)->id('step') !!}

{!! BootForm::select(trans('validation.attributes.category'), 'category_id', $model->categories->nest()->listsFlattened())->id('category_id') !!}

{!! BootForm::select(trans('validation.attributes.gradient'), 'gradient_id', $model->gradients->all())->id('gradient_id') !!}

{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}

{!! BootForm::select(
        trans('validation.attributes.insurance_blocks'),
        'insuranceBlocks[]',
        $model->insuranceBlocks->pluck('title', 'id')->all() + TypiCMS\Modules\Insuranceblocks\Models\Insuranceblock::all()->pluck('title', 'id')->all()
    )
    ->select($model->insuranceBlocks->pluck('id')->all())
    ->multiple(true)
    ->id('insurancePageInsuranceBlocks')
!!}

{!! BootForm::select(
        trans('validation.attributes.cards'),
        'cards[]',
        $model->cards->pluck('title', 'id')->all() + TypiCMS\Modules\Cards\Models\Card::all()->pluck('title', 'id')->all()
    )
    ->select($model->cards->pluck('id')->all())
    ->multiple(true)
    ->id('insurancePageInsuranceCards')
!!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}
