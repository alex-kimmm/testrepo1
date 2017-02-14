@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

@include('core::admin._buttons-form',['btn_form_show_preview' => false])

{!! BootForm::hidden('id') !!}

@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.image'), 'field_name' => 'image' ])

@include('core::admin._video-fieldset', [ 'field_title' => trans('validation.attributes.video'), 'field' => 'video' ])

{{--@include('core::form._title-and-slug')--}}
{!! TranslatableBootForm::text(trans('validation.attributes.title'), 'title') !!}

{!! TranslatableBootForm::text(trans('validation.attributes.subtitle'), 'subtitle') !!}

{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}

{!! BootForm::select('Product', 'product_id')
->options([''=>''] + $products) !!}

{!! BootForm::select('Page', 'page_id')
->options([''=>''] + $pages) !!}

{{--{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}--}}
{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->addClass('ckeditor') !!}
{!! TranslatableBootForm::textarea(trans('validation.attributes.body'), 'body')->addClass('ckeditor') !!}
