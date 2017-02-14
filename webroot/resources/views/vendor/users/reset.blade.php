@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Reset your password') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<section class="container container-1024">
    <div class="row blue-card">
        <div class="signin-container">
            <div class="signin-content">

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="zz-error zz-error-white">{{$error}}</p>
                    @endforeach
                @endif

                <p class="title">@lang('users::global.Reset your password')</p>

                <p id="status-message" class="hidden-by-default"></p>

                {!! BootForm::open() !!}

                    <div class="form-group">
                        {!! Form::password('password')->addClass('form-control input-lg input-password placeholder-fix-edge')->placeholder(trans('validation.attributes.password')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password_confirmation')->addClass('form-control input-lg password-confirmation input-password placeholder-fix-edge')->placeholder(trans('validation.attributes.password_confirmation')) !!}
                    </div>

                    {!! BootForm::hidden('token')->value($token) !!}

                    <div class="form-group form-action">
                        {!! BootForm::submit(trans('validation.attributes.Change password'), 'btn-signin') !!}
                    </div>

                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
</section>

@endsection