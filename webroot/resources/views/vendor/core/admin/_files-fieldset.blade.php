<div class="fieldset-media fieldset-file">

    @if(count($model->files()) > 0)
    <div class="fieldset-preview">
        @foreach($model->files as $file)
        <div id="_div_file_{{$file->id}}" class=" div-insurance-block-file-{{ $file->id }}">
            <a href="{{ $file->getFileUrl() }}" target="_blank">{{ $file->file }}</a>
            <a class="text-danger" href="javascript:removeFile('{{$file->id}}')">Remove</a>
        </div>
        @endforeach
    </div>
    @else
        <div class="col-md-12">There are no images</div>
    @endif

    <br/>
    <div class="fieldset-field">
        {!! BootForm::file($field_title, $field_name)->multiple(true)->accept($validFilesExtensions) !!}
    </div>
</div>
