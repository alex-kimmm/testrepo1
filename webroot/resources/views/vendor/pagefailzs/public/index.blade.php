@extends('pages::public.master')

@section('bodyClass', 'body-pagefailzs body-pagefailzs-index body-page body-page-' . $page->id)

@section('main')

    {!! $page->present()->body !!}

    @include('galleries::public._galleries', ['model' => $page])

    @if ($models->count())
    @include('pagefailzs::public._list', ['items' => $models])
    @endif

@endsection
