@extends('frontend.layouts.app')

@section('title', trans('users::global.My Policies') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')

@if(Session::has('success'))
<script>
    $(document).ready(function(){
        showNotification("{{ Session::get('success') }}", "body", "success", "top", "right", "auto", null, true);
    });
</script>
@endif

@if(Session::has('fail'))
<script>
    $(document).ready(function(){
        showNotification("{{ Session::get('fail') }}", "body", "danger", "top", "right", "auto", null, true);
    });
</script>
@endif

@if(isset($errors) && count($errors) > 0)
    @include('frontend.responses.errors', [ 'errors' => $errors ])
@endif

<div class="row">

        @include('frontend.inc._nav_account')

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="row">

                @foreach($policies as $policy)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="cards red-card account-gradient-card-size">
                            @include('frontend.inc._policy', ['policy'=>$policy])
                        </div>
                    </div>
                @endforeach

                @if(count($policies)%2!=0)
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">
                        <div class="cards red-card account-gradient-card-size">
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">
            <div class="cards green-card gradient-card-size"></div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">
            <div class="cards purple-card gradient-card-size"></div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">
            <div class="cards cyan-card gradient-card-size"></div>
        </div>
    </div>


@endsection

@section('js')
<script src="{{ asset("js/public/detectmobilebrowser.js") }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        if(jQuery.browser.mobile) {
            $('.make-claim a').attr('href','javascript:void(0)');
            $('.make-claim a').click(function(){
                goToScroll('html, body',$('.red-card:first-child').offset().top + 'px', 'fast');
            });
        }
    })
</script>
@endsection