@extends('core::admin.master')

@section('title', $model->present()->title)

@section('main')

    @include('core::admin._button-back', ['table' => $model->getTable()])
    <h1 class="@if(!$model->present()->title)text-muted @endif">{{ $model->present()->title ?: trans('core::global.Untitled') }}</h1>

    @include($model->getTable() . '::admin._view')

@endsection
