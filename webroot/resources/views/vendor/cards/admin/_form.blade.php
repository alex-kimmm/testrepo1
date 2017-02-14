@section('js')
    @parent
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.image'), 'field_name' => 'image' ])

{!! TranslatableBootForm::text(trans('validation.attributes.tag'), 'tag') !!}
{!! TranslatableBootForm::text(trans('validation.attributes.title'), 'title') !!}

{!! BootForm::text(trans('validation.attributes.title_background_color'), 'title_background_color')->addClass('pick-a-color') !!}

 @include('core::form._slug')
{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}
{!! BootForm::select(trans('validation.attributes.gradient'), 'gradient_id', ['0' => '--Please select gradient--'] + $model->gradients->all())->id('gradient_id') !!}
{!! TranslatableBootForm::text(trans('validation.attributes.redirect_link'), 'redirect_link') !!}
{!! TranslatableBootForm::hidden('open_link_new_tab')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.open_link_new_tab'), 'open_link_new_tab') !!}
{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}
