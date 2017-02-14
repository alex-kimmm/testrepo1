@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

@include('core::form._title-and-slug')
{!! TranslatableBootForm::hidden('status')->value(0) !!}
{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}

{!! BootForm::select(trans('validation.attributes.header_block'), 'header_block_id', ['' => '-- Plese select header block --'] + $headerBlocks) !!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}
{!! TranslatableBootForm::textarea(trans('validation.attributes.body'), 'body')->addClass('ckeditor') !!}

{!! BootForm::select(
        trans('validation.attributes.failzs_left'),
        'failzOptionsLeft[]',
        $model->failzOptionsLeft->pluck('title', 'id')->all() + TypiCMS\Modules\Failzs\Models\Failz::all()->pluck('title', 'id')->all()
    )
    ->select($model->failzOptionsLeft->pluck('id')->all())
    ->multiple(true)
    ->id('failzOptionsLeft')
!!}

{!! BootForm::select(
        trans('validation.attributes.failzs_right'),
        'failzOptionsRight[]',
        $model->failzOptionsRight->pluck('title', 'id')->all() + TypiCMS\Modules\Failzs\Models\Failz::all()->pluck('title', 'id')->all()
    )
    ->select($model->failzOptionsRight->pluck('id')->all())
    ->multiple(true)
    ->id('failzOptionsRight')
!!}

{!! BootForm::select(
        trans('validation.attributes.cards'),
        'cards[]',
        $model->cards->pluck('title', 'id')->all() + TypiCMS\Modules\Cards\Models\Card::all()->pluck('title', 'id')->all()
    )
    ->select($model->cards->pluck('id')->all())
    ->multiple(true)
    ->id('cards')
!!}