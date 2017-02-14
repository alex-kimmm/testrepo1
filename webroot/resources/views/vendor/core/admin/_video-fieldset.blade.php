<div class="fieldset-media fieldset-video">
    @if(isset($model->$field) && !empty($model->$field))
    <div class="fieldset-preview">
        <video width="320" height="220" poster="{{ asset($model->getImageUrl()) }}" controls>
           <source src="{{ asset($model->getVideoUrl()) }}" type="video/mp4">
           Your browser does not support the video tag.
        </video>

        <small class="text-danger delete-attachment" data-table="{{ $model->getTable() }}" data-id="{{ $model->id }}" data-field="{{ $field }}">Delete</small>
    </div>
    @endif
    <div class="fieldset-field">
        {!! BootForm::file(trans('validation.attributes.' . $field), $field) !!}
    </div>
</div>
