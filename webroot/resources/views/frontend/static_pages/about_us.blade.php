@extends('frontend.layouts.app')

@section('title', trans('users::global.About Us') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')

<section class="cards-grid">
    <div class="row cyan-gradient">
        <div class="content-page">
            <div class="container">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 title">
                    <h1>About Us</h1>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 content">
                    <h2>Every month we’re offering you the chance to become the face of ZugarZnap</h2>
                    <p>You’ll win a complete makeover with Guy Kremer <a href="http://guykremer.co.uk">www.guykremer.co.uk</a>. Guy is an internationally renowned for combining classic techniques with contemporary style.</p>

                    <p>Master of the make-over, Guy’s dextrous, quick and versatile handiwork is regularly seen in top titles such as Fabulous Magazine, Hello, OK, Cosmo, Good Housekeeping, Marie Claire, Vogue... the list goes on. His seasonal hair picture fashion collections are published in top trade magazines globally – Europe, Asia, Australia, the USA included. </p>

                    <p>And no stranger in celebrity circles, Guy has styled the hair of numerous media darlings for magazine editorials and always looks forward to the regular visits of celebrities.</p>

                    <p>To enter, all you need to do is post a side-by-side picture of you on your best day and your worst day (we’ve done a few of our own to get you started) on our Facebook page <a href="https://www.facebook.com/zugarznap" target="_blank">facebook.com/zugarznap</a>.</p>

                    <p>Each month we’ll pick our favourite.</p>

                    <h3>Are you the next face of ZugarZnap?</h3>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection