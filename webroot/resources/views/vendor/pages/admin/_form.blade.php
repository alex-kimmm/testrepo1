@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

@if(\Illuminate\Support\Facades\Session::has('error'))
<p class="bg-danger" style="padding: 10px;">{{ \Illuminate\Support\Facades\Session::get('error') }}</p>
@endif

{!! BootForm::hidden('id') !!}
{!! BootForm::hidden('position')->value($model->position ?: 0) !!}
{!! BootForm::hidden('parent_id') !!}

<ul class="nav nav-tabs">
    <li class="active">
        <a href="#tab-content" data-target="#tab-content" data-toggle="tab">@lang('global.Content')</a>
    </li>
    <li>
        <a href="#tab-meta" data-target="#tab-meta" data-toggle="tab">@lang('global.Meta')</a>
    </li>
    <li>
        <a href="#tab-options" data-target="#tab-options" data-toggle="tab">@lang('global.Options')</a>
    </li>
</ul>

<div class="tab-content">

    <div class="tab-pane fade in active" id="tab-content">
        <div class="row">
            <div class="col-md-6">
                {!! TranslatableBootForm::text(trans('validation.attributes.title'), 'title') !!}
            </div>
            @foreach ($locales as $lang)
            <div class="col-md-6 form-group form-group-translation @if($errors->has($lang.'.slug'))has-error @endif">
                <label class="control-label" for="{{ $lang }}[slug]"><span>@lang('validation.attributes.url')</span> ({{ $lang }})</label>
                <div class="input-group">
                    <span class="input-group-addon">/</span>
                    <input class="form-control" type="text" name="{{ $lang }}[slug]" id="{{ $lang }}[slug]" value="@if($model->hasTranslation($lang)){{ $model->translate($lang)->slug }}@endif" data-slug="{{ $lang }}[title]" data-language="{{ $lang }}">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-slug @if($errors->has($lang.'.slug'))btn-danger @endif" type="button">@lang('validation.attributes.generate')</button>
                    </span>
                </div>
                {!! $errors->first($lang.'.slug', '<p class="help-block">:message</p>') !!}
            </div>
            @endforeach
        </div>
        {!! TranslatableBootForm::hidden('uri') !!}
        {!! TranslatableBootForm::hidden('status')->value(0) !!}
        {!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}

        <hr>
        <style>
            .max { height: 200px; }
        </style>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label">How to add image to this static page</label>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label>First step:</label><br>
                <p>- Go to Files Module</p>
                <p>- Upload image file and Save</p>
                <p>- <a href="{{ asset('/img/static_pages/static_page_set_img_step_1.png') }}" target="_blank">Preview</a></p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label>Second step:</label><br>
                <p>- Click on Copy Link and 'copy file URL'</p>
                <p>- <a href="{{ asset('/img/static_pages/static_page_set_img_step_2.png') }}" target="_blank">Preview</a></p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label>Third step:</label><br>
                <p>- Come back in Static Pages Module</p>
                <p>- Open source body</p>
                <p>- <a href="{{ asset('/img/static_pages/static_page_set_img_step_3.png') }}" target="_blank">Preview</a></p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <label>Fourth step:</label><br>
                <p>- Paste into img tag copied link</p>
                <p>- <a href="{{ asset('/img/static_pages/static_page_set_img_step_4.png') }}" target="_blank">Preview</a></p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <p>
                    <a href="{{ asset('/img/static_pages/static_page_set_img_step_1.png') }}" target="_blank"><img class="max" src="{{ asset('/img/static_pages/static_page_set_img_step_1.png') }}"></a>
                </p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <p>
                    <a href="{{ asset('/img/static_pages/static_page_set_img_step_2.png') }}" target="_blank"><img class="max" src="{{ asset('/img/static_pages/static_page_set_img_step_2.png') }}"></a>
                </p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <p>
                    <a href="{{ asset('/img/static_pages/static_page_set_img_step_3.png') }}" target="_blank"><img class="max" src="{{ asset('/img/static_pages/static_page_set_img_step_3.png') }}"></a>
                </p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <p>
                    <a href="{{ asset('/img/static_pages/static_page_set_img_step_4.png') }}" target="_blank"><img class="max" src="{{ asset('/img/static_pages/static_page_set_img_step_4.png') }}"></a>
                </p>
            </div>
        </div>
        <hr>

        {!! TranslatableBootForm::textarea(trans('validation.attributes.body'), 'body')->addClass('ckeditor') !!}
        @include('core::admin._galleries-fieldset')
    </div>

    <div class="tab-pane fade" id="tab-meta">
        {!! TranslatableBootForm::text(trans('validation.attributes.meta_keywords'), 'meta_keywords') !!}
        {!! TranslatableBootForm::text(trans('validation.attributes.meta_description'), 'meta_description') !!}
    </div>

    <div class="tab-pane fade" id="tab-options">
        {!! BootForm::hidden('is_home')->value(0) !!}
        {!! BootForm::checkbox(trans('validation.attributes.is_home'), 'is_home') !!}
        {!! BootForm::hidden('private')->value(0) !!}
        {!! BootForm::checkbox(trans('validation.attributes.private'), 'private') !!}
        {!! BootForm::hidden('redirect')->value(0) !!}
        {!! BootForm::checkbox(trans('validation.attributes.redirect to first child'), 'redirect') !!}
        {!! BootForm::hidden('no_cache')->value(0) !!}
        {!! BootForm::checkbox(trans('validation.attributes.don’t generate HTML cache'), 'no_cache') !!}
        {!! BootForm::select(trans('validation.attributes.module'), 'module', TypiCMS::getModulesForSelect()) !!}

        {{--{!! BootForm::select('Quote', 'quote_id', ['' => ''] + TypiCMS\Modules\Quotes\Models\Quote::all()->pluck('title', 'id')->all()) !!}--}}

        {!! BootForm::select(trans('validation.attributes.template'), 'template', TypiCMS::templates())->helpBlock(TypiCMS::getTemplateDir()) !!}
        @if (!$model->id)
        {!! BootForm::select(trans('validation.attributes.add_to_menu'), 'add_to_menu', ['' => ''] + Menus::all()->pluck('title', 'id')->all(), null, array('class' => 'form-control')) !!}
        @endif
        {!! BootForm::textarea(trans('validation.attributes.css'), 'css') !!}
        {!! BootForm::textarea(trans('validation.attributes.js'), 'js') !!}
    </div>

</div>
