@extends('frontend_zz.layouts.app')

<<<<<<< HEAD
@section('title', 'My policies | ' .trans('users::global.My Account') . ' - ' . trans('users::global.ZugarZnap title'))
=======
@section('title', trans('users::global.My Account') . ' - ' . trans('users::global.ZugarZnap title'))
>>>>>>> test

@section('main')

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

<div class="row blue-background">

        @include('frontend_zz.inc._nav_account')

        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
            <div class="row">
                <div class="clearfix"></div>
                <h3 class="my-policies-header">my policies</h3>

                @if(count($policies) > 0)
                @foreach($policies as $key=> $policy)
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 policy-card-container {{($key%2==0)?'new_row':''}}">
                        @include('frontend_zz.inc._policy', ['policy'=>$policy])
                    </div>
                @endforeach

                @if(count($policies)%2!=0)
                    <div class="col-lg-6 col-md-6 col-sm-12 hidden-xs">
                    </div>
                @endif
                @else
                <div class="row your-policies">
                    <h2 class="your-order">
                        <?php $noPoliciesMessage = 'You don\'t have any purchased policies. Once you purchase a policy, they will appear here.'; ?>
                        <span class="hidden-xs">{{ $noPoliciesMessage }}</span>
                        <span class="visible-xs text-center">{{ $noPoliciesMessage }}</span>
                    </h2>
                </div>
                @endif

            </div>
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