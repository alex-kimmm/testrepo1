<div class="fieldset-media fieldset-images">
    <div class="fieldset-field">
        <p><b>{{ $field_title }}</b></p>
        <input type="file" id="{{ $field_name  }}" name="{{ $field_name }}[]" multiple="true" accept="{{ \TypiCMS\Modules\Products\Models\Product::$product_rules_valid_files_extensions }}"/>
    </div>
</div>
