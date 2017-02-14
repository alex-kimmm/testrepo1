@extends('pages::public.master')

@section('bodyClass', 'body-categories body-categories-index body-page body-page-' . $page->id)

@section('main')

    {!! $page->present()->body !!}

    @include('galleries::public._galleries', ['model' => $page])

    @if ($models->count())
    @include('categories::public._list', ['items' => $models])
    @endif

@endsection
