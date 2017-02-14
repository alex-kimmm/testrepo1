@extends('frontend_zz.layouts.app')

@section('title', trans('users::global.Make a claim') . ' - ' . trans('users::global.ZugarZnap title'))

@section('main')

<section class="cards-grid">
    <div class="row">
	    <div class="blue-background">
<<<<<<< HEAD
            <div class="make_claim-container">

                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-center">
                        <h1>Make a<br>claim</h1>
                    </div>

                    <div id="claim-form" class="col-lg-6 col-md-6 col-sm-6">
                        <p id="status-message" class="hidden-by-default" style="color: black;"></p>

                        <form class="form" role="form" action="/claims/create/{{ $quoteId }}" method="post" enctype="multipart/form-data" onsubmit="return validateClaimForm();">
                            <input type="text" class="hidden" name="quote_id" value="{{ $quoteId }}"/>

                            <span>I need to make a claim for my</span>
                            <div class="input-group make-claim-select object-margin-bottom" style="width: 100%;">
                                <select id="create-claim-product" name="claim_gadget_id">
                                    <option value="0">Please select</option>
                                    @foreach($claimGadgets as $i => $claimGadget)
                                        <optgroup label="{{ $i }}">
                                            @foreach($claimGadget as $gadget)
                                            <option value="{{ $gadget['id'] }}">{{ $gadget['brand'] }} - {{ $gadget['version'] }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <span class="was">Was</span>
                            <div class="make-claim-select make-claim-select-reason" style="width: 100%;">
                                <select id="create-claim-was" name="was" required>
                                    @foreach($reasons as $key => $reason)
                                    <option value="{{ $key }}">{{ $reason }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <span>Here is what happened:</span>
                            <div class="row form-group what-happened">
                                <textarea id="create-claim-description" class="form-control placeholder-fix-edge object-min-max-width-100-percents" name="description" rows="5" maxlength="5000" placeholder="Description" required></textarea>
                            </div>

                            <?php $userName = old('name')? old('name') : $authUser->last_name . ' ' . $authUser->first_name; ?>
                            <?php $userEmail = old('email')? old('email') : $authUser->email; ?>
                            <div class="input-group make-claim-input object-min-max-width-100-percents">
                                <input type="text" id="create-claim-username" class="form-control placeholder-fix-edge short-input" name="name"
                                        value="{{ $userName }}" placeholder="First / Last Name"
                                        data-placement="top" title="Please fill name input." required/>

                                <input type="email" id="create-claim-email" class="form-control placeholder-fix-edge object-align-to-right short-input" name="email" value="{{ $userEmail }}" placeholder="My Email" required/>

                                <input type="text" id="create-claim-contact-number" class="form-control input_digits_only placeholder-fix-edge short-input" name="contact_number" value="" placeholder="My Phone Number" required/>
                            </div>

                            <div class="input-group make-claim-input"></div>

                            <p>My evidence of ownership:</p>
                            <div class="container-fluid">
                                <div class="col-lg-9 col-md-8 col-sm-7 col-xs-5">
                                    <div id="make-claim-upload" class="input-group make-claim-input make-claim-upload">
                                        <input type="file" id="create-claim-files" name="files[]" multiple="true" accept="{{ $validFileExtensions }}"/>
                                        <span class="input-group-btn hidden-xs">
                                            <button id="id-claim-info-section-btn-open" class="btn btn-default" type="button">
                                                <img src="{{ asset('img/info.png') }}">
                                            </button>
                                        </span>
                                        <span class="input-group-btn hidden-sm hidden-md hidden-lg">
                                            <button type="button" style="width: 5px; border-radius: 0 4px 4px 0;">&nbsp;</button>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-7 object-align-to-right">
                                    <div class="claim-btn object-align-to-right">
                                        <button type="submit" id="create-claim-submit" class="btn btn-claim object-width-100-px">claim</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3"></div>
                </div>

            </div>
=======
	    	<div class="container">
		    	<div class="make_claim-container">

			    	<div class="row">
			    		<div class="col-lg-3 col-md-3 col-sm-3 text-center">
			    			<h1>Make a<br>claim</h1>
			    		</div>

			    		<div id="claim-form" class="col-lg-6 col-md-6 col-sm-6">
			    		    <p id="status-message" class="hidden-by-default" style="color: black;"></p>

			    		    <form class="form" role="form" action="/claims/create/{{ $quoteId }}" method="post" enctype="multipart/form-data" onsubmit="return validateClaimForm();">
                                <input type="text" class="hidden" name="quote_id" value="{{ $quoteId }}"/>

                                <span>I need to make a claim for my</span>
                                <div class="input-group make-claim-select object-margin-bottom" style="width: 100%;">
                                    <select id="create-claim-product" name="claim_gadget_id">
                                        <option value="0">Please select</option>
                                        @foreach($claimGadgets as $i => $claimGadget)
                                            <optgroup label="{{ $i }}">
                                                @foreach($claimGadget as $gadget)
                                                <option value="{{ $gadget['id'] }}">{{ $gadget['brand'] }} - {{ $gadget['version'] }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>

                                <span class="was">Was</span>
                                <div class="make-claim-select make-claim-select-reason" style="width: 100%;">
                                    <select id="create-claim-was" name="was" required>
                                        @foreach($reasons as $key => $reason)
                                        <option value="{{ $key }}">{{ $reason }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <span>Here is what happened:</span>
                                <div class="row form-group what-happened">
                                    <textarea id="create-claim-description" class="form-control placeholder-fix-edge object-min-max-width-100-percents" name="description" rows="5" maxlength="5000" placeholder="Description" required></textarea>
                                </div>

                                <?php $userName = old('name')? old('name') : $authUser->last_name . ' ' . $authUser->first_name; ?>
                                <?php $userEmail = old('email')? old('email') : $authUser->email; ?>
                                <div class="input-group make-claim-input object-min-max-width-100-percents">
                                    <input type="text" id="create-claim-username" class="form-control placeholder-fix-edge short-input" name="name"
                                            value="{{ $userName }}" placeholder="First / Last Name"
                                            data-placement="top" title="Please fill name input." required/>

                                    <input type="email" id="create-claim-email" class="form-control placeholder-fix-edge object-align-to-right short-input" name="email" value="{{ $userEmail }}" placeholder="My Email" required/>

                                    <input type="text" id="create-claim-contact-number" class="form-control input_digits_only placeholder-fix-edge short-input" name="contact_number" value="" placeholder="My Phone Number" required/>
                                </div>

                                <div class="input-group make-claim-input"></div>

                                <p>My evidence of ownership:</p>
                                <div class="container-fluid">
                                    <div class="col-lg-9 col-md-8 col-sm-7 col-xs-5">
                                        <div id="make-claim-upload" class="input-group make-claim-input make-claim-upload">
                                            <input type="file" id="create-claim-files" name="files[]" multiple="true" accept="{{ $validFileExtensions }}"/>
                                            <span class="input-group-btn hidden-xs">
                                                <button id="id-claim-info-section-btn-open" class="btn btn-default" type="button">
                                                    <img src="{{ asset('img/info.png') }}">
                                                </button>
                                            </span>
                                            <span class="input-group-btn hidden-sm hidden-md hidden-lg">
                                                <button type="button" style="width: 5px; border-radius: 0 4px 4px 0;">&nbsp;</button>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-7 object-align-to-right">
                                        <div class="claim-btn object-align-to-right">
                                            <button type="submit" id="create-claim-submit" class="btn btn-claim object-width-100-px">claim</button>
                                        </div>
                                    </div>
                                </div>
						    </form>
			    		</div>

			    		<div class="col-lg-3 col-md-3 col-sm-3"></div>
			    	</div>

		    	</div>
	    	</div>
>>>>>>> test

	    	<div id="id-claim-info-section" class="claims-info-div myD1 loading">
                <div class="close-info sidebar-close" onclick="claimInfoSection.toggle();"></div>
                <div class="open-info"><img src="{{ asset('img/open-info.png') }}"></div>
                <div class="make_claim-container" style="padding: unset;">
                <div class="make-claim-badge">
                    <div class="hidden-xs">
                        <span>evidence of</span>
                        <span>ownership</span>
                    </div>
                    <div class="visible-xs"><span>evidence of ownership</span></div>
                </div>
                <p>Receipt, invoice, mobile phone contract, tablet contract</p>
                </div>
            </div>
	    </div>
	</div>
</section>

@endsection

@section('js')

<script>
    $(document).ready(function(){
        $( "#make-claim-upload" ).on( "click", ".file-upload-input", function() {
            $( this ).parent().find(".file-upload-button").trigger("click");
        });
    });
</script>

@if(Session::has('success'))
<script>
    $(document).ready(function(){
        showMessage('success', '{{ Session::get('success') }}');
    });
</script>
@endif

@if(Session::has('fail'))
<script>
    $(document).ready(function(){
        showMessage('error', '{{ Session::get('fail') }}');
        claimsScrollableToErrorsMessages();
    });
</script>
@endif

@if(Session::has('errors'))
<script>
    $(document).ready(function(){
        showMessage('error', '{{  Session::get('errors')->first() }}');
        claimsScrollableToErrorsMessages();
    })
</script>
@endif
@endsection