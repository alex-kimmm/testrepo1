@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>

    <script>
        function removeFile(fileId){

            if(!confirm('Are you sure?')) return;

            $.ajax({
                url    : '/api/insuranceblocks/file/delete/' + fileId,
                method : 'get',
                beforeSend : function() {
                    // todo : show loader, set interactions to false
                }
            })
            .done(function(rsp) {
                if(rsp.success == 1) {
                    $('#_div_file_' + fileId).remove();
                }
                else {
                    alert("Something went wrong, try again later");
                }
            })
            .fail(function(rsp) {
                alert("Something went wrong, try again later");
            })
            .always(function() {
                // todo : hide loader, set interactions to true
            });
        }
        </script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.image'), 'field_name' => 'image' ])
@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.image_mobile'), 'field_name' => 'image_mobile' ])
{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}
<hr>
{!! BootForm::select('position', 'position', ['' => ''] + $positions ) !!}
<hr>
{!! TranslatableBootForm::hidden('in_menu')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.in_menu'), 'in_menu') !!}
{!! TranslatableBootForm::text(trans('validation.attributes.menu_title'), 'menu_title') !!}
<hr>
{!! TranslatableBootForm::hidden('title_hidden')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.title_hidden'), 'title_hidden') !!}
@include('core::form._title-and-slug')
<hr>
{!! TranslatableBootForm::text(trans('validation.attributes.heading'), 'heading') !!}
{!! TranslatableBootForm::text(trans('validation.attributes.second_heading'), 'second_heading') !!}
{!! TranslatableBootForm::text(trans('validation.attributes.decor_heading'), 'decor_heading') !!}
{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}

<hr>
{!! TranslatableBootForm::text(trans('validation.attributes.button_title'), 'button_title') !!}
{!! TranslatableBootForm::text(trans('validation.attributes.button_link'), 'button_link')->placeholder('http://') !!}
@include('core::admin._files-fieldset', [ 'field_title' => trans('validation.attributes.files') . '(Only ' . $validFilesExtensions . ' files)', 'field_name' => 'files[]', 'validFilesExtensions' => $validFilesExtensions ])
<hr>

@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.first_logo'), 'field_name' => 'first_logo' ])
{!! TranslatableBootForm::textarea(trans('validation.attributes.first_logo_text'), 'first_logo_text')->rows(4) !!}
{!! TranslatableBootForm::textarea(trans('validation.attributes.first_logo_description'), 'first_logo_description')->rows(4) !!}

@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.second_logo'), 'field_name' => 'second_logo' ])
{!! TranslatableBootForm::textarea(trans('validation.attributes.second_logo_text'), 'second_logo_text')->rows(4) !!}
{!! TranslatableBootForm::textarea(trans('validation.attributes.second_logo_description'), 'second_logo_description')->rows(4) !!}

@include('core::admin._image-fieldset', [ 'field_title' => trans('validation.attributes.third_logo'), 'field_name' => 'third_logo' ])
{!! TranslatableBootForm::textarea(trans('validation.attributes.third_logo_text'), 'third_logo_text')->rows(4) !!}
{!! TranslatableBootForm::textarea(trans('validation.attributes.third_logo_description'), 'third_logo_description')->rows(4) !!}
