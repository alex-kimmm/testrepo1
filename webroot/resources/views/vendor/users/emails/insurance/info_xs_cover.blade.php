@extends('frontend.layouts.email')

@section('subject', $subject)

@section('title', $subject)

@section('main')

<p>Hi {{$order->user->first_name}} {{$order->user->last_name}},</p>

<p>You’re the newest member of ZugarZnap!</p>

<p>We’re changing the way people think about insurance.</p>

<p>Our products are great value and simple to understand.</p>

<p>Life’s too short for small print.</p>

<p>But hey you knew that already. Good call.</p>

<p>I want to share a few tips to help you get the most out of ZugarZnap.</p>

<p>We've got you covered for your car insurance excess up to the amount you selected. That means that if you have an accident that's your fault and claim on your car insurance, we'll cover the excess up to that amount. Simple eh?<br>
Giving something back</p>

<p>Let's face it, who really enjoys paying for insurance? We get that, so with us you get a bit of retail therapy as well.</p>

<p>Free album download<br>
Featuring talented emerging artists from around the world. To claim your FREE DOWNLOAD click here <a href="{{ url('/ZugarZnap_Music_Album.zip') }}">link</a></p>
<<<<<<< HEAD

<p>Stay safer on the road. Put your driving to the test with ZnapTrack. You can also download and get access to the ZnapTrack mobile application for your <a target="_blank" href="https://itunes.apple.com/gb/app/znaptrack/id1106967353?mt=8">iOS</a> or <a target="_blank" href="https://play.google.com/store/apps/details?id=com.hubio.zugarznap">Android</a> device.</p>
=======
>>>>>>> test

<p>Plus, every product purchase provides a day’s clean water for an African child as part of our Buy One Give One https://www.b1g1.com/businessforgood/ charity donations.</p>

<p>Thanks for joining ZugarZnap.</p>

<p>— Julie and the ZZ Team</p>

@endsection
