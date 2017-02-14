@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.My Account') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<section class="cards-grid">
    <div class="row blue-background">

    @include('frontend_zz.inc._nav_account')

        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
            <div class="account-tab-container">
                <div class="account-tab my-detailes">
                    <div class="detail-section col-md-6 col-sm-6">
                        <div class="row">
                            <div class="edit-account">
                                <img src="{{ asset('img/pen.png') }}">
                            </div>
                            <h3>you</h3>
                        </div>

                        <div class="edit-detail-section-info">
                            @if(Session::has('success'))
                            <p class="zz-message zz-message-white">{{ Session::get('success') }}</p>
                            @endif

                            @if(Session::has('fail'))
                            <p class="zz-error zz-error-white">{{ Session::get('fail') }}</p>
                            @endif

                            @if (Session::has('errors') && count(Session::get('errors')) > 0)
                            @foreach (Session::get('errors')->all() as $error)
                                <p class="zz-error zz-error-white">
                                    {{ $error }}
                                </p>
                            @endforeach
                            @endif

                            <form id="my_details_form" role="form" action="/profile/my-details" method="post">
                                <div class="row form-group form-group-inline">
                                    <div class="col-md-3 padding">
                                        <select class="form-control dark-drop-down" name="usertitle_id">
                                            <?php $oldUserTitleId = (old('usertitle_id')) ? old('usertitle_id') : $user->usertitle_id; ?>
                                            @foreach($userTitles as $i => $socialTitle)
                                            <option value="{{ $i }}" {{ $oldUserTitleId == $i ? 'selected' : '' }}>{{ $socialTitle }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 padding">
                                        <?php $first_name = (old('first_name')) ? old('first_name') : $user->first_name; ?>
                                        <input type="text" name="first_name" class="form-control placeholder-fix-edge" value="{{ $first_name }}" placeholder="First Name" required="required"/>
                                    </div>
                                    <div class="col-md-5">
                                        <?php $last_name = (old('last_name')) ? old('last_name') : $user->last_name; ?>
                                        <input type="text" name="last_name" class="form-control placeholder-fix-edge" value="{{ $last_name }}" placeholder="Last Name" required="required"/>
                                    </div>
                                </div>

                                @if(!$isAuthWithOAuth)
                                <div class="form-group">
                                    <input type="password" class="form-control input-password placeholder-fix-edge" name="old_password" placeholder="Old password"/>
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control input-password placeholder-fix-edge" name="password" placeholder="Password"/>
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control input-password placeholder-fix-edge" name="password_confirmation" placeholder="Password confirmation"/>
                                </div>
                                @endif

                                <button class="btn btn-yellow-save" disabled>save change(s)</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>

@endsection

@section('js')
@if (Session::has('success') || (Session::has('fail') || (Session::has('errors') && count(Session::get('errors')) > 0)))
<script>
    $(document).ready(function(){
        if($('.mobile-intern-nav').is(':visible')){ // only mobile version
            var scrollValue = $('.edit-detail-section-info').offset();
            goToScroll('html, body', scrollValue.top, 500);
        }

        var mq = window.matchMedia( "(min-width: 768px)" );
        if(mq.matches) {
            sameHeight();
        }

        $(window).bind('resize', function () {
            sameHeight();
        });
    });

    function sameHeight() {
        if($('.my-detailes').outerHeight() > $('.account-list').outerHeight()) {
            $('.account-list').outerHeight($('.my-detailes').outerHeight());
        }
        else {
            $('.my-detailes').outerHeight($('.account-list').outerHeight());
            $('.account-tab-container').outerHeight($('.account-list').outerHeight());
        }
    }
</script>
@endif
<script>
    $(document).ready(function(){
        $("#my_details_form input").keyup(function() {
            $('button.btn-yellow-save').prop('disabled', false);
        });
        $("select[name='usertitle_id']").change(function() {
            var isDisabled = $('button.btn-yellow-save').is(':disabled');
            if (isDisabled) {
                $('button.btn-yellow-save').prop('disabled', false);
            }
        });
    });
</script>
@endsection
