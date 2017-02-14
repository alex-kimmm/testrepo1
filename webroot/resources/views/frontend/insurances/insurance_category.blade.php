@extends('frontend.layouts.app')

@section('title', 'insurance ' . $category->title)

@section('main')

    @foreach($categories as $cat)
    <span><a href="{{ $cat->getSeoUrl() }}">{{ $cat->title }}</a></span> |
    @endforeach

    <hr>

    @foreach($category->products as $product)

    <div style="border: 1px solid #cccccc; padding: 10px; margin: 10px;">
    <a href="{{$product->getSeoUrl()}}">{{ $product->title }}</a> <br>

    Price: {{ $product->price }} <br>

    </div>
    @endforeach
@endsection