@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Resend activation') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<section class="container container-1024">
    <div class="row blue-card">
        <div class="signin-container">
            <div class="signin-content">
                <p class="title">@lang('users::global.RESEND ACTIVATION')</p>

                @if(Session::has('success'))
                    <p class="zz-message zz-message-white">{{ Session::get('success') }}</p>
                @endif

                @if(Session::has('fail'))
                    <p class="zz-error zz-error-white">{{ Session::get('fail') }}</p>
                @endif

                @if(count($errors->all()) > 0)
                    @if(count($errors->all()) > 1)
                    @foreach ($errors->all() as $error)
                    <p class="zz-error zz-error-white">{{ $error }}</p>
                    @endforeach
                    @elseif(count($errors->all()) == 1)
                    <p class="zz-error zz-error-white">{{ $errors->first() }}</p>
                    @endif
                @endif

                <p id="status-message" class="hidden-by-default"></p>

                <br/>
                {!! BootForm::open()->onsubmit('return(resendActivation());') !!}
                    <div class="form-group">
                        {!! Form::email('email')->addClass('form-control input-lg placeholder-fix-edge')->id('resend-activation-input-email')->placeholder(trans('validation.attributes.email'))->autofocus(true)->required(true) !!}
                    </div>

                    <div class="signin-button">
                        {!! BootForm::submit(trans('validation.attributes.resend activation'), 'btn-signin')->id('resend-activation-input-submit') !!}
                    </div>
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
</section>

@endsection