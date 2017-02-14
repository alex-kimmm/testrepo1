@extends('frontend.layouts.email')

@section('subject', 'Policy documents')

@section('title','Policy documents')

@section('main')

<p>Hi {{$user->first_name}} {{$user->last_name}},</p>

<p>Thanks for buying from ZugarZnap. Great to have you on board.</p>

<p>Your policy documents are attached to this email - please keep them safe (but you can always access them via your account on zugarznap.com)</p>

<p>If you’ve got any questions email help@zugarznap.com or call us on 0800 1977 218</p>

<p>— Julie & Team ZZ</p>

<p>Follow us on Twitter @ZugarZnap we promise not to be dull.</p>

<p>We’ve got a monthly competition to find the Face of ZZ. Win a makeover with the country’s top stylist just for sending us a pic of you on your best (and worst) days. Enter via our <a target="_blank" href="https://www.facebook.com/zugarznap">Facebook page</a></p>

<p>Don’t forget your Free album download featuring talented emerging artists from around the world. To claim your FREE DOWNLOAD <a target="_blank" href="{{ url('/ZugarZnap_Music_Album.zip') }}">click here</a></p>
<<<<<<< HEAD

=======
>>>>>>> test
@endsection
