@extends('core::public.master')

@section('title', $page->title . ' – ' . $websiteTitle)
@section('ogTitle', $page->title)
@section('description', $page->meta_description)
@section('keywords', $page->meta_keywords)
@if ($page->image)
@section('image', url($page->present()->thumbSrc()))
@endif
@section('bodyClass', 'body-page body-page-' . $page->id)

@section('css')
    @if($page->css)
    <style type="text/css">
        {{ $page->css }}
    </style>
    @endif
@endsection

@section('js')
    @if($page->js)
    <script>
        {{ $page->js }}
    </script>
    @endif
@endsection

@section('main')

    @include('pages::public.cookie')

    @yield('page')

    <!-- jQuery 2.2.2 -->
    <script src="/js/public/jquery-2.2.2.min.js"></script>

    @if(!(isset($_COOKIE['zugarznap-cookies-accepted']) && $_COOKIE['zugarznap-cookies-accepted'] != null))
    <!-- Cookies -->
    <script src="/js/public/jquery.cookie.js"></script>
    @endif

    <!-- UI actions -->
    <script src="/js/public/main.js"></script>

@endsection
