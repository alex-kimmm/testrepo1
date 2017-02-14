<div class="policy-item">
    <div class="off-today-container">
        @if($policy->is_expired)
            <div class="btn-off-today">
                <a href="">Expired</a>
            </div>
        @elseif($policy->statusId == POLICY_STATUS_PAID)
            <div class="btn-off-today">
                <a href="">Purchased</a>
            </div>
        @endif
    </div>
    <div class="account-card" style="background-image: url('{{\App\Http\IWEPApiController::getImageForIWEPCategory($policy->productID)}}');">
        <div class="account-card-info card-info-light">
            <div class="card-details">
                <div class="card-price-container">
                    <p class="card-price card-price-light">£{{formatPrice($policy->soldPricetoCustomer)}}</p>
                </div>
                <?php
                    switch($policy->productID){
                        case IWEP_CATEGORY_GADGET_INSURANCE: {
                            $text = 'Your gadgets are';
                            break;
                        }
                        case IWEP_CATEGORY_XS_COVER: {
                            $text = 'Your car is';
                            break;
                        }
                        default:
                            $text = 'Your insurance is';
                    }
                ?>
                <p class="card-title blue-text-color">{{$text}} covered up to {{$policy->price_options[0]->optionName}}</p>
                <div class="account-buttons policy-buttons">
                    @if(!$policy->is_expired)
                        <a class="btn btn-orange" href="/claims/create/{{ $policy->quoteID }}">Make a claim</a>
                    @endif
                    <a target="_blank" class="btn btn-orange" href="{{$policy->pdf_documents->policySummaryFileRef}}">Key facts</a>
                    <a target="_blank" class="btn btn-orange" href="{{$policy->pdf_documents->policyFileRef}}">policy wording</a>
                    @if($policy->statusId == POLICY_STATUS_PAID)
                        <a target="_blank" href="{{$policy->pdf_documents->download_certificate_url}}" class="btn btn-orange">Certificate</a>
                    @endif
                </div>
                <div class="card-like"></div>
            </div>
        </div>
    </div>
    <div class="text-deco-card hidden-xs"></div>
</div>