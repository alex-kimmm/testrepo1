<?php $btn_do_show_preview = (isset($btn_form_show_preview))? $btn_form_show_preview : true; ?>
<div class="btn-toolbar">
    <button class="btn-primary btn" value="true" id="exit" name="exit" type="submit">@lang('validation.attributes.save and exit')</button>
    <button class="btn-default btn" type="submit">@lang('validation.attributes.save')</button>
    @if ( $btn_do_show_preview && method_exists($model, 'previewUri') && $previewUri = $model->previewUri())
    <a class="btn btn-default btn-preview" href="{{ $previewUri }}?preview=true">@lang('validation.attributes.preview')</a>
    @endif
    @include('core::admin._lang-switcher', ['js' => true])
</div>
