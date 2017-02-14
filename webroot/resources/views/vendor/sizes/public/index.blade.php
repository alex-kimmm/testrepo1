@extends('pages::public.master')

@section('bodyClass', 'body-sizes body-sizes-index body-page body-page-' . $page->id)

@section('main')

    {!! $page->present()->body !!}

    @include('galleries::public._galleries', ['model' => $page])

    @if ($models->count())
    @include('sizes::public._list', ['items' => $models])
    @endif

@endsection
