<?php
/**
 * Created by PhpStorm.
 * User: vitalie
 * Date: 13/04/2016
 * Time: 13:14
 */

namespace App\Libraries\ST;


use Omnipay\SecureTrading\Message\PurchaseRequest;

class STAbstractPurchaseRequest extends PurchaseRequest  {

    public function getRequestBlock() {
        return $this->getData()->request;
    }

}