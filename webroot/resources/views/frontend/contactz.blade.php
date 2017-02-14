@extends('frontend.layouts.app')

@section('title', trans('users::global.Contactz') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._quote', ['quote'=>$quote])
@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')

<section class="cards-grid">
    <div class="row purple-gradient">
	    <div class="contact-page" style="overflow-x: hidden; width: 100%; position: relative">
	        <div class="wrapper-right-slider wrapper-right-slider-closed hidden-xs">
                @include('frontend/inc/_contactz_not_from_uk', ['mobile' => false])
	        </div>
		    <div class="container centered-container">
		    	<div class="col-lg-3 col-md-3 col-sm-3 hidden-xs">
		    		<div class="text-deco-hi hidden-xs">
                        <div class="text-deco-hi-contents">Hi!</div>
                    </div>
		    	</div>
		    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-xs-12-custom-mobile">
			    	<div class="contact-info">
			    		<h2 class="contact-title">Contact</h2>
			    		<div class="call-us row">
			    			<h3>Call us</h3>
			    			<p>0800 1977 218</p>
			    		</div>
			    		<div class="email-us row">
			    			<h3>Email us</h3>
			    			<p>help@zugarznap.com</p>
			    		</div>
			    		<div class="find-us row">
			    			<h3>Find us</h3>
			    			<p>	ZugarZnap® Group Ltd<br>
			    				71-75 Shelton Street<br>
			    				Covent Garden<br>
			    				London
			    			</p>
			    		</div>
			    	</div>
			    	<div class="not-from-uk">
			    		<h2 class="contact-title">Not from the uk?</h2>
			    		<ul class="list-inline hidden-xs">
			    			<li><a href="javascript:void(0)" onclick="openSlide(1)">Jersey</a></li>
			    			<li><a href="javascript:void(0)" onclick="openSlide(2)">Guernsey</a></li>
			    			<li><a href="javascript:void(0)" onclick="openSlide(3)">Isle of man</a></li>
			    			<li><a href="javascript:void(0)" onclick="openSlide(4)">Alderney</a></li>
			    		</ul>
			    		<ul class="list-inline hidden-lg hidden-md hidden-sm">
                            <li><a href="javascript:void(0)" onclick="changeContent(1, true)">Jersey</a></li>
                            <li><a href="javascript:void(0)" onclick="changeContent(2, true)">Guernsey</a></li>
                            <li><a href="javascript:void(0)" onclick="changeContent(3, true)">Isle of man</a></li>
                            <li><a href="javascript:void(0)" onclick="changeContent(4, true)">Alderney</a></li>
                        </ul>
			    	</div>
		    	</div>
		    	<div class="col-lg-3 col-md-3 col-sm-3 hidden-xs">

		    	</div>
			</div>

			<div class="container contactz-mobile hidden-lg hidden-md hidden-sm hidden-xs">
				@include('frontend/inc/_contactz_not_from_uk', ['mobile' => true])
			</div>

			<div id="map" style="">
				<div style="opacity: 0.7">
					<script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:480px;width:100%;'><div id='gmap_canvas' style='height:480px;width:100%;'></div><div><small><a href="http://embedgooglemaps.com">									embed google maps							</a></small></div><div><small><a href="http://www.proxysitereviews.com/">proxies</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type='text/javascript'>function init_map(){var myOptions = {draggable: (isMobileDevice.any() ? false : true),zoom:10,center:new google.maps.LatLng(51.51124974325286,-0.1568654071288611),mapTypeId: google.maps.MapTypeId.ROADMAP,scrollwheel: false};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(51.51124974325286,-0.1568654071288611)});infowindow = new google.maps.InfoWindow({content:'<strong>ZugarZnap® Group Ltd</strong><br>71-75 Shelton Street Covent Garden London<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('.wrapper-right-slider').height($('.centered-container').height());
    });

    function openSlide(n) {
        changeContent(n,false);
        $('.centered-container').addClass('centered-container-to-left');
        $('.wrapper-right-slider').removeClass('wrapper-right-slider-closed').addClass('wrapper-right-slider-opened').height($('.centered-container').height());
    }

    function closeSlides() {
        $('.centered-container').removeClass('centered-container-to-left');
        $('.wrapper-right-slider').addClass('wrapper-right-slider-closed').removeClass('wrapper-right-slider-opened');
    }

    function closeMobileInfo() {
        $('.contactz-mobile').removeClass('visible-xs').addClass('hidden-lg hidden-md hidden-sm hidden-xs');
    }

    function changeContent(n, mobile) {
        if(mobile) {
            $('.contactz-mobile').addClass('visible-xs').removeClass('hidden-lg hidden-md hidden-sm hidden-xs');
        }

        var $locationFrom = $('._contactz_from_');
        var $locationGif = $('.contactz-gif');
        var $locationName = $('.location-name');
        var $locationDescription = $('.location-description');
        var $locationLogoContainer = $('.location-logo');
        var $locationDetailFirst = $('.location-detail-1');
        var $locationDetailSecond = $('.location-detail-2');

        $locationFrom.text('From');
        switch (n) {
            case 1:
                $locationGif.css('background-image', 'url({{ asset('/img/jersey_v2.gif') }})');
                $locationName.text('jersey?');
                $locationDescription.text('On the beautiful island of Jersey you have the added benefit of being able to talk to our friends at Rossborough insurance.');
                $locationDetailFirst.text('R A Rossborough (Insurance Brokers) Limited');
                $locationDetailSecond.text('PO Box 28, 41 La Motte Street, St Helier, Jersey, JE4 8NS');
                break;
            case 2:
                $locationGif.css('background-image', 'url({{ asset('/img/guernsey.gif') }})');
                $locationName.text('guernsey?');
                $locationDescription.text('On the beautiful island of Guernsey you have the added benefit of being able to talk to our friends at Rossborough insurance.');
                $locationDetailFirst.text('R A Rossborough (Guernsey) Limited');
                $locationDetailSecond.text('P O Box 127, Rossborough House, Bulwer Avenue, St Sampson, Guernsey, GY2 4LF');
                break;
            case 3:
                $locationGif.css('background-image', 'url({{ asset('/img/isleofman.gif') }})');
                $locationFrom.text('From isle');
                $locationName.text('of man?');
                $locationDescription.text('On the beautiful island of Isle of Man you have the added benefit of being able to talk to our friends at Rossborough insurance.');
                $locationDetailFirst.text('Rossborough Insurance (IOM) Limited');
                $locationDetailSecond.text('New Wing, Victory House, Prospect Hill, Douglas, Isle of Man, IM1 1EQ');
                break;
            case 4:
                $locationGif.css('background-image', 'url({{ asset('/img/alderney.gif') }})');
                $locationName.text('alderney?');
                $locationDescription.text('On the beautiful island of Alderney you have the added benefit of being able to talk to our friends at Rossborough insurance.');
                $locationDetailFirst.text('R A Rossborough (Guernsey) Limited - Alderney Branch');
                $locationDetailSecond.text('P O Box 30, 11 Victoria Street, St Anne, Alderney, GY9 3UF');
                break;
            default :
                $locationGif.css('background-image', 'url({{ asset('/img/contactgif.gif') }})');
                $locationName.text('');
                $locationDescription.text('');
                $locationDetailFirst.text('');
                $locationDetailSecond.text('');
        }
    }

</script>
@endsection