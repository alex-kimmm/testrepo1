@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.image'), 'field_name' => 'image' ])

@include('core::form._title-and-slug')

{!! TranslatableBootForm::textarea(trans('validation.attributes.card_title'), 'card_title')->addClass('ckeditor') !!}

{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}

{!! BootForm::text(trans('validation.attributes.button_title'), 'button_title') !!}

{!! BootForm::text(trans('validation.attributes.button_link'), 'button_link') !!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.body'), 'body')->addClass('ckeditor') !!}
