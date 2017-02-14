@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

@include('core::form._title-and-slug')

{!! TranslatableBootForm::hidden('status')->value(0) !!}

{!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}

{!! BootForm::select(trans('validation.attributes.header_block'), 'header_block_id', ['' => ''] + $headerBlocks) !!}

{!! BootForm::select(
        trans('validation.attributes.page_blocks'),
        'homePageBlocks[]',
        $model->homePageBlocks->pluck('title', 'id')->all() + TypiCMS\Modules\Homepageblocks\Models\Homepageblock::all()->pluck('title', 'id')->all()
    )
    ->select($model->homePageBlocks->pluck('id')->all())
    ->multiple(true)
    ->id('musicLandingPagePageBlocks')
!!}

{!! BootForm::select(
        trans('validation.attributes.cardCoverBlocks'),
        'cardCoverBlocks[]',
        $model->cardCoverBlocks->pluck('title', 'id')->all() + TypiCMS\Modules\Cardcoverblocks\Models\Cardcoverblock::all()->pluck('title', 'id')->all()
    )
    ->select($model->cardCoverBlocks->pluck('id')->all())
    ->multiple(true)
    ->id('cardCoverBlocks')
!!}

{!! BootForm::select(
        trans('validation.attributes.cards'),
        'cards[]',
        $model->cards->pluck('title', 'id')->all() + TypiCMS\Modules\Cards\Models\Card::all()->pluck('title', 'id')->all()
    )
    ->select($model->cards->pluck('id')->all())
    ->multiple(true)
    ->id('musicLandingPageCards')
!!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}

{!! TranslatableBootForm::textarea(trans('validation.attributes.body'), 'body')->addClass('ckeditor') !!}
