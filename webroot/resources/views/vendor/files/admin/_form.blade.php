@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection


@include('core::admin._buttons-form')

<div class="row">

    {!! BootForm::hidden('id') !!}
    @if($model->gallery_id)
    {!! BootForm::hidden('gallery_id') !!}
    @endif
    {!! BootForm::hidden('type') !!}
    {!! BootForm::hidden('position')->value($model->position ?: 0) !!}
    {!! BootForm::hidden('path') !!}
    {!! BootForm::hidden('extension') !!}
    {!! BootForm::hidden('mimetype') !!}
    {!! BootForm::hidden('width') !!}
    {!! BootForm::hidden('height') !!}

    <div class="col-sm-6">
        {!! TranslatableBootForm::text(trans('validation.attributes.alt_attribute'), 'alt_attribute') !!}
        {!! TranslatableBootForm::textarea(trans('validation.attributes.description'), 'description') !!}

        @if($model->file != null && isset($model->file) && !empty($model->file))
        <hr>
        <div>
            {!! TranslatableBootForm::text(trans('validation.attributes.file_path'), 'file_path')->value(asset($model->path . '/' . $model->file))->id('module-files-copy-uri-to-current-file')->disabled(true) !!}
            <a id="module-files-exec-copy-uri" onclick="copyLink('{{ $model->file }}', '{{ asset($model->path . '/' . $model->file) }}');" href="#" data-copytarget="#module-files-copy-uri-to-current-file">Copy Link</a>
        </div>
        @endif
    </div>

    <div class="col-sm-6">

        @include('core::admin._file-fieldset', ['field' => 'file'])

        <table class="table table-condensed">
            <thead>
                <th>{{ trans('validation.attributes.file information') }}</th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                    <th>{{ trans('validation.attributes.path') }}</th>
                    <td>{{ $model->path }}</td>
                </tr>
                <tr>
                    <th>{{ trans('validation.attributes.filename') }}</th>
                    <td>{{ $model->file }}</td>
                </tr>
                <tr>
                    <th>{{ trans('validation.attributes.extension') }}</th>
                    <td>{{ $model->extension }}</td>
                </tr>
                <tr>
                    <th>{{ trans('validation.attributes.mimetype') }}</th>
                    <td>{{ $model->mimetype }}</td>
                </tr>
                @if ($model->width)
                <tr>
                    <th>{{ trans('validation.attributes.width') }}</th>
                    <td>{{ $model->width }} px</td>
                </tr>
                @endif
                @if ($model->height)
                <tr>
                    <th>{{ trans('validation.attributes.height') }}</th>
                    <td>{{ $model->height }} px</td>
                </tr>
                @endif
            </tbody>
        </table>

    </div>

</div>
