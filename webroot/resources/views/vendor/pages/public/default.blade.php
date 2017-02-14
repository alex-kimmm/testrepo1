@extends('frontend_zz.layouts.app')

@section('title', $page->present()->title)

@section('main')

@include('frontend.inc._quote', ['quote'=>$quote])

<section class="cards-grid">
    <div class="row cyan-gradient">
	    <div class="content-page">
		    <div class="container static-pages">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content">
                    <h2>{{ $page->present()->title }}</h2>
                    {!! $page->present()->body !!}
                </div>
            </div>
		</div>
	</div>
</section>

@endsection
