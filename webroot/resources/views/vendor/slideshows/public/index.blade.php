@extends('pages::public.master')

@section('bodyClass', 'body-slideshows body-slideshows-index body-page body-page-' . $page->id)

@section('main')

    {!! $page->present()->body !!}

    @include('galleries::public._galleries', ['model' => $page])

    @if ($models->count())
    @include('slideshows::public._list', ['items' => $models])
    @endif

@endsection
