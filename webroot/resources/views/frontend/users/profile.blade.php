@extends('frontend.layouts.app')

@section('title', trans('users::global.Profile') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<br/>
<a href="/profile/orders-view">My Orders</a>
<br/>
<br/>

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

{!! BootForm::open($user, ['route' => ['profile.update'], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post'] ) !!}

    <div class="form-group{{ isset($errors) ? $errors->has('usertitle_id') ? ' has-error' : '' : ''}}">
        <div class="col-md-6">
            {!! BootForm::select(trans('validation.attributes.title'), 'usertitle_id', TypiCMS\Modules\Usertitles\Models\Usertitle::all()->pluck('title', 'id')->all(), null, array('class' => 'form-control'))->select($user->usertitle_id) !!}

            @if (isset($errors) && $errors->has('usertitle_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('usertitle_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ isset($errors) ? $errors->has('first_name') ? ' has-error' : '' : ''}}">
        <div class="col-md-6">
            {!! BootForm::text(trans('validation.attributes.first_name'), 'first_name')->value($user->first_name)->placeholder(trans('validation.attributes.first_name'))->addClass('placeholder-fix-edge') !!}

            @if (isset($errors) && $errors->has('first_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ isset($errors) ? $errors->has('last_name') ? ' has-error' : '' : ''}}">
        <div class="col-md-6">
            {!! BootForm::text(trans('validation.attributes.last_name'), 'last_name')->value($user->last_name)->placeholder(trans('validation.attributes.last_name'))->addClass('placeholder-fix-edge') !!}

            @if (isset($errors) && $errors->has('last_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ isset($errors) ? $errors->has('email') ? ' has-error' : '' : ''}}">
        <div class="col-md-6">
            Email&nbsp;<b>{!! $user->email !!}</b>

            @if (isset($errors) && $errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    @if(!$isAuthWithOAuth)
    <hr>

    <div class="form-group{{ isset($errors) ? $errors->has('old_password') ? ' has-error' : '' : ''}}">
        <div class="col-md-6">
            {!! BootForm::password(trans('validation.attributes.old_password'), 'old_password')->placeholder(trans('validation.attributes.old_password'))->addClass('placeholder-fix-edge') !!}

            @if (isset($errors) && $errors->has('old_password'))
                <span class="help-block">
                    <strong>{{ $errors->first('old_password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ isset($errors) ? $errors->has('password') ? ' has-error' : '' : ''}}">
        <div class="col-md-6">
            {!! BootForm::password(trans('validation.attributes.password'), 'password')->placeholder(trans('validation.attributes.password'))->addClass('placeholder-fix-edge') !!}

            @if (isset($errors) && $errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ isset($errors) ? $errors->has('password_confirmation') ? ' has-error' : '' : ''}}">
        <div class="col-md-6">
            {!! BootForm::password(trans('validation.attributes.password_confirmation'), 'password_confirmation')->placeholder(trans('validation.attributes.password_confirmation'))->addClass('placeholder-fix-edge') !!}

            @if (isset($errors) && $errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @endif

    <div class="form-group form-action">
        {!! BootForm::submit(trans('validation.attributes.Save'), 'btn-primary') !!}
    </div>

{!! BootForm::close() !!}

@endsection