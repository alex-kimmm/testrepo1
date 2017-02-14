@extends('frontend.layouts.email')

@section('subject', 'Welcome')

@section('title','Welcome to ZugarZnap!')

@section('main')
<p>Hi</p>

<p>Thanks for signing up with ZugarZnap. Great to have you on board.</p>

<p>To activate your account, <a style="background-color:#ffdc00;padding:14px 16px;-webkit-border-radius: 4px; -moz-border-radius: 4px;border-radius:4px;line-height:18px!important;font-size:27px;font-family:'museo-sans',sans-serif;font-weight:900;color:#f70a4d;text-decoration:none;display:inline-block;line-height:18px!important; text-transform: lowercase;-webkit-box-shadow: 4px 4px 4px 0px rgba(0,0,0,0.2); -moz-box-shadow: 4px 4px 4px 0px rgba(0,0,0,0.2); box-shadow: 4px 4px 4px 0px rgba(0,0,0,0.2);" target="_blank" href="{{ route('activate', $user->token) }}">click here.</a></p>

<p>I want to change the way people think about insurance.</p>

<p>ZugarZnap is made for people who’d rather listen to the Frozen soundtrack on repeat for twelve days than think about financial services (Let it Goooo!)</p>

<p>Our products are great value and simple to understand. Life’s too short for small print.</p>

<p>If you’ve got any questions or feedback – good and bad, we want it all :) Reply to this email or write to help@zugarznap.com.
</p>

<p>— Julie & Team ZZ</p>

<p>Follow us on Twitter @ZugarZnap we promise not to be dull.</p>
<p>We’ve got a monthly competition to find the Face of ZZ. Win a makeover with the country’s top stylist just for sending us a pic of you on your best (and worst) days. Enter via our <a target="_blank" href="https://www.facebook.com/zugarznap">Facebook page</a></p>
@endsection