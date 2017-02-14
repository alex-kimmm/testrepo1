@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.home_block_background_image'), 'field_name' => 'block_background_image' ])

@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.image'), 'field_name' => 'image' ])

@include('core::form._title-and-slug')

{!! BootForm::text(trans('validation.attributes.subtitle'), 'subtitle') !!}

{!! TranslatableBootForm::hidden('status')->value(0) !!}

{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}

{!! BootForm::text(trans('validation.attributes.benefits_url'), 'benefits_url')->placeholder('http://') !!}

{!! BootForm::select('position', 'position', ['' => ''] + $position ) !!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.body'), 'body')->addClass('ckeditor') !!}
