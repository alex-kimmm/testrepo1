@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! TranslatableBootForm::text(trans('validation.attributes.title'), 'title') !!}

{!! BootForm::hidden('id') !!}

{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}
{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(12) !!}
