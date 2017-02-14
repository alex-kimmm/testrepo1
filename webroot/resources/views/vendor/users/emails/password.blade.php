@extends('frontend.layouts.email')

@section('subject', 'Password Reset')

@section('title','Password Reset')

@section('main')
<p>
    @lang('users::global.To reset your password'),
    <a target="_blank" href="{{ route('changepassword', $token) }}">@lang('users::global.click here').</a></p>
<p>
    @lang('users::global.Or point your browser to this address:') <br />
    {{ route('changepassword', $token) }}
</p>
@endsection

@section('button')
<tr><td align="center" valign="top">
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr><td align="center" valign="top">
                <a href="{{ route('changepassword', $token) }}" style="background-color:#ffdc00;padding:14px 16px;-webkit-border-radius: 4px; -moz-border-radius: 4px;border-radius:4px;line-height:18px!important;font-size:27px;font-family:'museo-sans',sans-serif;font-weight:900;color:#f70a4d;text-decoration:none;display:inline-block;line-height:18px!important; text-transform: lowercase;-webkit-box-shadow: 4px 4px 4px 0px rgba(0,0,0,0.2); -moz-box-shadow: 4px 4px 4px 0px rgba(0,0,0,0.2); box-shadow: 4px 4px 4px 0px rgba(0,0,0,0.2);" target="_blank">Reset your password</a>
            </td></tr>
        </tbody>
    </table>
</td></tr>
@endsection