@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.image'), 'field_name' => 'image' ])
@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.image_mobile'), 'field_name' => 'image_mobile' ])

@include('core::admin._video-fieldset', ['field' => 'video'])

@include('core::form._title-and-slug')

{!! TranslatableBootForm::hidden('status')->value(0) !!}

{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}

{!! TranslatableBootForm::hidden('auto_play')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.auto_play'), 'auto_play') !!}

{!! BootForm::text(trans('validation.attributes.quote_text'), 'quote_text') !!}

{!! BootForm::text(trans('validation.attributes.quote_subtext'), 'quote_subtext') !!}

{!! BootForm::select('position', 'position', ['' => ''] + $position ) !!}

{!! BootForm::select(trans('validation.attributes.gradient'), 'gradient_id', $model->gradients->all())->id('gradient_id') !!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.body'), 'body')->addClass('ckeditor') !!}
