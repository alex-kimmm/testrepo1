<div class="fieldset-media fieldset-image">
    {{-- property_exists($model, $field_name) --}}
    @if( isset($field_name) && !empty($model->$field_name) && $model->$field_name)
    <div class="fieldset-preview">
        {!! $model->present()->thumb(150, 150, ['resize'], $field_name) !!}
        <small class="text-danger delete-attachment" data-table="{{ $model->getTable() }}" data-id="{{ $model->id }}" data-field="{{ $field_name }}">Delete</small>
    </div>
    @endif
    <div class="fieldset-field">
        {!! BootForm::file($field_title, $field_name) !!}
    </div>
</div>
