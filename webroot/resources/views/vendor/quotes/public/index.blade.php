@extends('pages::public.master')

@section('bodyClass', 'body-quotes body-quotes-index body-page body-page-' . $page->id)

@section('main')

    {!! $page->present()->body !!}

    @include('galleries::public._galleries', ['model' => $page])

    @if ($models->count())
    @include('quotes::public._list', ['items' => $models])
    @endif

@endsection
