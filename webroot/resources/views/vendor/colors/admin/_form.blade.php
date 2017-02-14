@section('js')
    @parent
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

<div class="btn-toolbar">
    <button class="btn-primary btn" value="true" id="exit" name="exit" type="submit">@lang('validation.attributes.save and exit')</button>
    <button class="btn-default btn" type="submit">@lang('validation.attributes.save')</button>
    @include('core::admin._lang-switcher', ['js' => true])
</div>

{!! BootForm::hidden('id') !!}

<div class="row">
    <div class="col-md-6">
        {!! TranslatableBootForm::text(trans('validation.attributes.title'), 'title') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        {!! BootForm::text(trans('validation.attributes.color_code'), 'color_code')->addClass('pick-a-color') !!}
    </div>
</div>

{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}
