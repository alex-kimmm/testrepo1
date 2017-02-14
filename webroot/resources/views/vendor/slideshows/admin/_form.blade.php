@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

@include('core::form._title-and-slug')
{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}

{!! BootForm::select(
        'Slideshow Items',
        'slideshowitems[]',
        $model->slideshowitems->pluck('title', 'id')->all() + TypiCMS\Modules\Slideshowitems\Models\Slideshowitem::all()->pluck('title', 'id')->all()
    )
    ->select($model->slideshowitems->pluck('id')->all())
    ->multiple(true)
    ->id('slideshowitems')
!!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}
{!! TranslatableBootForm::textarea(trans('validation.attributes.body'), 'body')->addClass('ckeditor') !!}
