<?php

namespace App\Libraries\ST;


use Omnipay\SecureTrading\Message\PurchaseRequest;

class STRecurringPurchaseRequest extends STAbstractPurchaseRequest {


    public function getAction($flag = false)
    {
        if($flag) return "AUTH";
        return $this->getApplyThreeDSecure() ? 'THREEDQUERY' : 'SUBSCRIPTION';
    }

    /**
     * Sets subscription.
     *
     * @param STSubscription $value
     * @return AbstractRequest Provides a fluent interface
     */
    public function setSubscription($value) {
        if ($value && !$value instanceof STSubscription) {
            $value = new STSubscription($value);
        }
        $this->setParameter('subscription', $value);
    }

    /**
     * @return STSubscription
     */
    public function getSubscription()
    {
        return $this->getParameter('subscription');
    }




    /**
     * @param SimpleXMLElement $data
     */
    protected function setSubscriptionElement(\SimpleXMLElement $data)
    {
        $sub = $this->getSubscription();

        /** @var SimpleXMLElement $subscription */

        $subscription = $data->addChild('subscription');
        $subscription->addAttribute('type', "RECURRING");

        $subscription->addChild('betgindate', $sub->getBegindate());
        $subscription->addChild('finalnumber', $sub->getFinalnumber());
        $subscription->addChild('frequency', $sub->getFrequency());
        $subscription->addChild('unit', $sub->getUnit());
        $subscription->addChild('number', $sub->getNumber());

        return $data;

    }


    public function getData() {
        $data = parent::getData();

        if ($this->getSubscription()) {
            $this->setSubscriptionElement($data->request->billing);
        }

        $merchant = $data->request->merchant;
        $merchant->addChild('merchantnumber', env('ST_MERCHANT_NR'));

<<<<<<< HEAD
        $data->request->operation->accounttypedescription = env('PAYMENT_TYPE', 'ECOM');
=======
        $data->request->operation->accounttypedescription = PAYMENT_TYPE;
>>>>>>> test

        return $data;

    }



} 