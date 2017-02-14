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

<p>We’ve got you covered. That means you can claim for any gadgets you own up to the amount you chose in a year. All we’ll need is proof of ownership when you make a claim. Simple eh?</p>

<p>And if you need to contact us you can call us on 0800 1977 218 or email us help@zugarznap.com<br>
Some retail therapy</p>

<p>Let’s face it, who really enjoys paying for insurance? We get that, so with us you get a (not so little) bit of retail therapy too.</p>

<p>Free ZnapCard<br>
£1300 of savings including 2 for 1 cinema tickets, a Taste Card with 50% OFF or 2 for 1 at 6,515 UK restaurants as well as big discounts from many high street shops. You’ll receive a separate email with instructions about how to register for your virtual ZnapCard.</p>

<p>Free album download<br>
Featuring talented emerging artists from around the world. To claim your FREE DOWNLOAD click here <a href="{{ url('/ZugarZnap_Music_Album.zip') }}">link</a></p>
<<<<<<< HEAD

<p>Stay safer on the road. Put your driving to the test with ZnapTrack. You can also download and get access to the ZnapTrack mobile application for your <a target="_blank" href="https://itunes.apple.com/gb/app/znaptrack/id1106967353?mt=8">iOS</a> or <a target="_blank" href="https://play.google.com/store/apps/details?id=com.hubio.zugarznap">Android</a> device.</p>

<p>As part of your purchase of your Gadget policy we are in the process of signing you up for your Znapcard® - giving you access to over £2,000 worth of benefits. Once this process is complete  you will receive an email with your account details, and a link to the ZnapCard® portal. This should be with you in the next 24-48hrs.</p>
=======
>>>>>>> test

<p>Plus, every product purchase provides a day’s clean water for an African child as part of our Buy One Give One https://www.b1g1.com/businessforgood/ charity donations.</p>

<p>Thanks for joining ZugarZnap.</p>

<p>— Julie and the ZZ Team</p>

@endsection
