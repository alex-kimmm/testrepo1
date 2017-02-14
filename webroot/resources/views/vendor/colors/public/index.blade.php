@extends('pages::public.master')

@section('bodyClass', 'body-colors body-colors-index body-page body-page-' . $page->id)

@section('main')

    {!! $page->present()->body !!}

    @include('galleries::public._galleries', ['model' => $page])

    @if ($models->count())
    @include('colors::public._list', ['items' => $models])
    @endif

@endsection
