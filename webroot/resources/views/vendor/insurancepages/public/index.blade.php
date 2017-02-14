@extends('pages::public.master')

@section('bodyClass', 'body-insurancepages body-insurancepages-index body-page body-page-' . $page->id)

@section('main')

    {!! $page->present()->body !!}

    @include('galleries::public._galleries', ['model' => $page])

    @if ($models->count())
    @include('insurancepages::public._list', ['items' => $models])
    @endif

@endsection
