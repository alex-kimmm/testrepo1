<?php

namespace App\Libraries\ST;

class STPurchaseRequest extends STAbstractPurchaseRequest {

    public function setRecurring() {

        $data = parent::getData();

            /** @var SimpleXMLElement $merchant */
            $data->request->attributes()->type = "SUBSCRIPTION";

        return $data;
    }

    /**
     * @return SimpleXMLElement
     */
    public function getData()
    {
        $data = parent::getData();

<<<<<<< HEAD
        $merchant = $data->request->merchant;
        $merchant->addChild('merchantnumber', env('ST_MERCHANT_NR'));

        $data->request->operation->accounttypedescription = env('PAYMENT_TYPE', 'ECOM');
=======
        if ($this->getApplyThreeDSecure()) {
            $this->validate('returnUrl');

            /** @var SimpleXMLElement $merchant */
            $merchant = $data->request->merchant;
            $merchant->addChild('termurl', $this->getReturnUrl());

            /** @var SimpleXMLElement $customer */
            $customer = $data->request->customer ?: $data->request->addChild('customer');
            $customer->addChild('accept', $this->getAccept());
            $customer->addChild('useragent', $this->getUserAgent());
        }

        $merchant = $data->request->merchant;
        $merchant->addChild('merchantnumber', env('ST_MERCHANT_NR'));

        $data->request->operation->accounttypedescription = PAYMENT_TYPE;
>>>>>>> test

        return $data;
    }

}