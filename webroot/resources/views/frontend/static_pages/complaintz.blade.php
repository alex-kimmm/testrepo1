@extends('frontend.layouts.app')

@section('title', trans('users::global.Complaintz') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

@include('frontend.inc._nav')
@include('frontend.inc._nav-mobile-intern')

<section class="cards-grid">
    <div class="row cyan-gradient">
	    <div class="content-page">
		    <div class="container">
		    	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 title">
		    		<h1>How do  I make a complaint?</h1>
		    		<img src="{{ URL('img/panda.gif') }}" class="text-img img-responsive">
		    	</div>
		    	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 content">
		    		<h2>Complaints information Our aim is always to provide our custome</h2>
					<p>Our aim is always to provide our customers with a first-class service; however we are aware that, occasionally, it is possible that we may fail to meet your expectations. If for any reason we have not met your expectations, let us know as soon as possible, by calling our main office telephone <span>0800 1977 218</span></p>
					<p>or write to</p>
					<div><span>The Complaints Manager,</span></div>
					<div><span>The ZugarZnap Group Ltd,</span></div>
					<div><span>71-75 Shelton Street,</span></div>
					<div><span>Covent Garden,</span></div>
					<div><span>London WC2H 9JQ</span></div>
					<p>or email</p>
					<a href="mailto:help@zugarznap.com" target="_top">help@zugarznap.com</a>
					<p>If we are unable to resolve the issue to your satisfaction by the end of the next business day, we will formally investigate the matter. You will receive an acknowledgement of the matter together with a copy of our complaints process promptly and certainly within 5 working days. We will then aim to investigate and provide a resolution as quickly as possible, informing you of the position at no later than 4 weeks and a final response no later than 8 weeks.</p>

					<p>If you are not happy with our response, or the position after a period of 8 weeks, you may be eligible to refer your complaint to the Financial Ombudsman Service (FOS) for an independent assessment and opinion. </p>
					<p>The <span>FOS Consumer Helpline</span> is on <span>0800 023 4567</span> (free for people phoning from a "fixed line" (for example, a landline at home) or <span>0300 123 9 123</span> (free for mobile-phone users paying monthly charge for calls to No's starting 01 or 02). Alternatively you can contact them at Financial Ombudsman Service, Exchange Tower, Harbour Exchange Square, London, E14 9SR. </p>

					<a href="www.financial-ombudsman.org.uk">www.financial-ombudsman.org.uk</a>

					<p>A full copy of our complaints procedure is available on request.</p>

					<h3>Financial Services Compensation Scheme (FSCS)</h3>

					<p>If we are unable to meet our obligations, you may be entitled to compensation from the FSCS. If we have advised or arranged insurance for you this will be covered for 90% of a claim, without any upper limit, however compulsory classes of insurance (such as motor insurance) is covered for 100% of a claim. Further information is available from the <span>FSCS helpline</span> on <span>0800 678 1100</span> or <span>020 7741 4100</span> and <a href="www.fscs.org.uk">www.fscs.org.uk</a>.</p>

					<p>The FSCS is the UK's statutory fund of last resort for customers of authorised financial services firms. Compensation is usually payable if an authorised firm is unable or unlikely to pay claims usually because it has ceased trading or become insolvent'.</p>

					<div class="back-button">
						<button class="btn btn-yellow" onclick="goToPage('/profile/my-details');">Back</button>
					</div>
		    	</div>
			</div>
		</div>
	</div>
</section>

@endsection