@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Register') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<section class="container container-1024">
    <div class="row blue-card">
        <div class="signin-container">
            <div class="register-content hide-default-errors">
                <p class="title">@lang('users::global.Create an account')</p>

                @include('frontend._show_messages')

                @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="register-button">
                    <button class="btn btn-signin" onclick="goSignIn();">@lang('users::global.Sign in')</button>
                </div>
                @else
                    {!! BootForm::open()->onsubmit('return(register());') !!}
                        {!! BootForm::select(trans('validation.attributes.title'), 'usertitle_id', TypiCMS\Modules\Usertitles\Models\Usertitle::all()->pluck('title', 'id')->all(), null, array('class' => 'form-control'))->hideLabel()->id('register-input-social-title')->addClass('red-drop-down remove-arrow-from-drop-down') !!}
                        {!! BootForm::text(trans('validation.attributes.first_name'), 'first_name')->hideLabel()->id('register-input-first-name')->placeholder('First name')->addClass('input-lg placeholder-fix-edge')->required() !!}
                        {!! BootForm::text(trans('validation.attributes.last_name'), 'last_name')->hideLabel()->id('register-input-last-name')->placeholder('Last name')->addClass('input-lg placeholder-fix-edge')->required() !!}
                        {!! BootForm::email(trans('validation.attributes.email'), 'email')->hideLabel()->id('register-input-email')->placeholder('Email')->addClass('input-lg placeholder-fix-edge')->required() !!}
                        {!! BootForm::password(trans('validation.attributes.password'), 'password')->hideLabel()->id('register-input-password')->placeholder('Password')->addClass('input-lg placeholder-fix-edge input-password')->required() !!}
                        {!! BootForm::password(trans('validation.attributes.password_confirmation'), 'password_confirmation')->hideLabel()->id('register-input-password_confirm')->placeholder('Confirm password')->addClass('input-lg placeholder-fix-edge input-password')->required() !!}

                        <div class="form-group form-action">
                            {!! BootForm::submit(trans('validation.attributes.Create account'), 'btn-signin')->id('register-input-submit') !!}
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