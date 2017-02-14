<?php $relatedProductCover = \App\Http\IWEPApiController::getRelatedProduct($policy->productID);?>
<?php $cssClass = ($relatedProductCover->category_id == CATEGORY_GADGET_INSURANCE)?
'green-to-yellow-diagonal-gradient' :
'red-to-orange-diagonal-gradient';
?>

<div class="policy-item">
    <div class="policy-card {{$cssClass}}">
        <div class="policy-card-inside">
            <div class="policy-card-top">
                <h3 class="policy-product-title">{{$relatedProductCover->title}}</h3>
                <div class="policy-image" style="background-image: url('{{$relatedProductCover->getImageUrl()}}');"></div>
            </div>
            <div class="policy-card-body">
                @if($policy->is_expired)
                    <span class="policy-status-label">Expired</span>
                @elseif($policy->statusId == POLICY_STATUS_PAID)
                    <span class="policy-status-label">Purchased</span>
                @endif

                <?php
                    switch($policy->productID){
                        case IWEP_CATEGORY_GADGET_INSURANCE: {
                            $textInfo = 'Your gadgets are covered up to';
                            break;
                        }
                        case IWEP_CATEGORY_XS_COVER: {
<<<<<<< HEAD
                            $textInfo = 'Your car excess is covered up to';
=======
                            $textInfo = 'Your car excess is reduced to';
>>>>>>> test
                            break;
                        }
                        default:
                            $textInfo = 'Your insurance is covered up to';
                    }
                ?>

                <h2 class="policy-product-info">{{$textInfo}} {{$policy->price_options[0]->optionName}}</h2>
                <ul class="policy-buttons">

                    @if(!$policy->is_expired)
                        @if($policy->productID == IWEP_CATEGORY_GADGET_INSURANCE)
<<<<<<< HEAD
{{--                        <li><a href="/claims/create/{{ $policy->quoteID }}">Make a claim</a></li>--}}
                        <li><a href="/gadget-claim">Make a claim</a></li>
=======
                        <li><a href="/claims/create/{{ $policy->quoteID }}">Make a claim</a></li>
>>>>>>> test
                        @else
                        <li><a href="/xs-claim">Make a claim</a></li>
                        @endif
                    @endif

                    <li><a target="_blank" href="{{$policy->pdf_documents->policySummaryFileRef}}">Key facts</a></li>
                    <li><a target="_blank" href="{{$policy->pdf_documents->policyFileRef}}">Policy wording</a></li>

                    @if($policy->statusId == POLICY_STATUS_PAID)
                        <li><a target="_blank" href="{{$policy->pdf_documents->download_certificate_url}}">Certificate</a></li>
                    @endif

                </ul>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>