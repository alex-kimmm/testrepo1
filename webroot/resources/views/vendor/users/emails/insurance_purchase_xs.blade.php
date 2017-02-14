@extends('frontend.layouts.email')

@section('subject', 'Insurance purchase')

@section('title','Insurance purchase')

@section('main')
<p>Hi</p>

<p>You’re the newest member of ZugarZnap! *little cheer*</p>

<p>We’re changing the way people think about insurance.</p>

<p>Our products are great value and simple to understand.</p>

<p>Life’s too short for small print.</p>

<p>But hey you knew that already. Good call.</p>

<p>I want to share a few tips to help you get the most out of ZugarZnap.</p>

<p>We’ve got you covered. That means you can claim for any gadgets you own up to the amount you chose in a year. All we’ll need is proof of ownership when you make a claim. Simple eh?</p>

<h2>Giving something back</h2>

<p>Let’s face it, who really enjoys paying for insurance? We get that, so with us you get a bit of retail therapy as well.</p>

<p><strong>Free ZnapCard</strong><br />
£1300 of savings including 2 for 1 cinema tickets, a Taste Card with 50% OFF or 2 for 1 at 6,515 UK restaurants as well as big discounts from many high street shops. You’ll receive a separate email with instructions about how to register for your virtual ZnapCard.</p>

<p><strong>Free album download</strong><br />
Featuring talented emerging artists from around the world. To claim your FREE DOWNLOAD <a href="{{ url('/ZugarZnap_Music_Album.zip') }}">click here</a></p>

<p>Plus, every product purchase provides a day’s clean water for an African child as part of our Buy One Give One [https://www.b1g1.com/businessforgood/] charity donations.</p>

<p>Thanks for joining ZugarZnap.</p>

<p>— Julie and the ZZ Team</p>
@endsection