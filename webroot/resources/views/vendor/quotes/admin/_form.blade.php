@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

@include('core::admin._buttons-form',['btn_form_show_preview' => false])

{!! BootForm::hidden('id') !!}

{!! TranslatableBootForm::text(trans('validation.attributes.title'), 'title') !!}
{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}
{!! TranslatableBootForm::text(trans('validation.attributes.quote_page_url'), 'uri') !!}
{!! TranslatableBootForm::text(trans('validation.attributes.quote_page_redirect_url'), 'redirect_url') !!}
{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}

{!! BootForm::select('position', 'position', ['' => ''] + $position ) !!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.body'), 'body')->addClass('ckeditor') !!}
