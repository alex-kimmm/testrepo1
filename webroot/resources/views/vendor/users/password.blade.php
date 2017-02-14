@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Reset your password') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<section class="container container-1024">
    <div class="row blue-card">
        <div class="signin-container">
            <div class="signin-content">

                @if($errors->any())
                    {{--<p class="zz-error zz-error-white">{{$errors->first()}}</p>--}}
                    @foreach ($errors->all() as $error)
                        <p class="zz-error zz-error-white">{{$error}}</p>
                    @endforeach
                @endif

                <p class="title">@lang('users::global.Reset your password')</p>

                <p id="status-message" class="hidden-by-default"></p>

                @if(Session::has('success'))

                <p class="zz-message zz-message-white">{{ Session::get('success') }}</p>

                <div class="register-button">
                    <button class="btn btn-signin" onclick="goSignIn();">@lang('users::global.Sign in')</button>
                </div>

                @else

                {!! BootForm::open()->onsubmit('return(resetYourPassword());') !!}
                    <div class="form-group">
                        {!! Form::email('email')->addClass('form-control input-lg placeholder-fix-edge')->placeholder(trans('validation.attributes.email'))->id('pass-input-email')->autofocus(true)->required() !!}
                    </div>

                    <div class="form-group form-action">
                        {!! BootForm::submit(trans('validation.attributes.reset your password'), 'btn-signin')->id('pass-input-submit') !!}
                    </div>
                {!! BootForm::close() !!}

                <div class="forget-pass">
                    <a href="{{ route('login') }}">@lang('users::global.Already have an account? Sign in here.')</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection