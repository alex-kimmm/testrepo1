@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.failz-preview').click(function(){
                var $this = $(this);
                $this.html('');
                $this.append('<img src="' + $this.data('gif') + '" class="failz-preview">');
            });
        });
    </script>
@endsection

<div class="btn-toolbar">
    <button class="btn-primary btn" value="true" id="exit" name="exit" type="submit">@lang('validation.attributes.save and exit')</button>
    <button class="btn-default btn" type="submit">@lang('validation.attributes.save')</button>
    @include('core::admin._lang-switcher', ['js' => true])
</div>

{!! BootForm::hidden('id') !!}

@if( trim($model->obj_link) != "" )
<div class="failz-preview" data-gif="{{ $model->obj_link }}" data-gif-placeholder="{{ $model->obj_link_placeholder }}">
    <img src="{{ $model->obj_link_placeholder }}" class="failz-preview">
</div>
@endif

{!! TranslatableBootForm::text(trans('validation.attributes.title'), 'title') !!}

{!! BootForm::text(trans('validation.attributes.obj_link'), 'obj_link') !!}
{!! BootForm::text(trans('validation.attributes.obj_link_placeholder'), 'obj_link_placeholder') !!}

{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}

{!! BootForm::hidden('inappropriate')->value(0) !!}

{!! BootForm::hidden('is_giphy')->value(0) !!}

{!! BootForm::hidden('content_type')->value(0) !!}
{!! BootForm::hidden('user_id')->value(0) !!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}
