@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Sign in') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<section class="container container-1024">
    <div class="row blue-card">
        <div class="signin-container">
            <div class="signin-content">
                <p class="visible-xs title">@lang('users::global.Sign in')</p>

                @if(Session::has('success'))
                    <p class="zz-message zz-message-white">{{ Session::get('success') }}</p>
                @endif

                @if(count($errors->all()) > 0)
                    @if(count($errors->all()) > 1)
                    @foreach ($errors->all() as $error)
                    <p class="zz-error zz-error-white">{{ $error }}</p>
                    @endforeach
                    @elseif(count($errors->all()) == 1)
                    <p class="zz-error zz-error-white">{{ $errors->first() }}</p>
                    @endif
<<<<<<< HEAD
                @endif

                @if( Session::has('auth_user_activated') && !Session::get('auth_user_activated'))
                <p class="zz-message zz-message-white">
                    <a class="color-green" href="{{ route('resendconfirmationemail') }}">@lang('users::global.Activate user')</a>
                </p>
=======
>>>>>>> test
                @endif

                <p id="status-message" class="hidden-by-default"></p>

                <div class="facebook-button">
                    <button class="btn btn-fb" onclick="goToPage('/auth/facebook');">connect with facebook</button>
                </div>
                <p class="or">or</p>

                {!! BootForm::open()->onsubmit('return(login());') !!}
                    <div class="form-group">
                        {!! Form::email('email')->addClass('form-control input-lg placeholder-fix-edge')->placeholder(trans('validation.attributes.email'))->autofocus(true)->id('login-input-email')->required() !!}
                    </div>

                    <div class="form-group">
                        {!! Form::password('password')->addClass('form-control input-lg placeholder-fix-edge input-password')->placeholder(trans('validation.attributes.password'))->id('login-input-password')->required() !!}
                    </div>

                    <div class="forget-pass">
                        <a href="{{ route('register') }}">@lang('users::global.Create an account.')</a>
                        <br/>
                        <a href="{{ route('resetpassword') }}">@lang('users::global.Forgot your password?')</a>
                    </div>

                    <div class="signin-button">
                        {!! BootForm::submit(trans('validation.attributes.sign in'), 'btn-signin')->id('login-input-submit') !!}
                    </div>
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
</section>

@endsection