@extends('frontend_zz.layouts.app')

@section('title', $page->present()->title)

@section('main')

<section class="cards-grid">
    <div class="row cyan-gradient">
	    <div class="content-page">
	        <div class="container static-pages">
                {!! $page->present()->body !!}
            </div>
		</div>
	</div>
</section>

@endsection
