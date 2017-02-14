<?php
/**
 * Created by PhpStorm.
 * User: vitalie
 * Date: 12/04/2016
 * Time: 21:26
 */

namespace App\Libraries\ST;


use Omnipay\SecureTrading\Gateway;
use Socket\Raw\Factory;

class STGateway extends Gateway {

    private $hostname;
    private $port;
    private $socket;
    private $merchantnumber;

    function init($hostname,$port) {
        $this->hostname = $hostname;
        $this->port = $port;
        $this->merchantnumber = env('ST_MERCHANT_NR');
    }


//    public function send(Request $request) {
    public function send($data) {
        $factory = new Factory();
        $this->socket = $factory->createClient($this->hostname.':'.$this->port);
        $this->socket->write($data);
        $response = $this->socket->read(8192);
        $this->socket->close();
        return $response;
    }

    /**
     * @param array $parameters
     * @return STPurchaseRequest
     */
    public function threeDSecure(array $parameters = array())
    {
        return $this->createRequest('\App\Libraries\ST\STPurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return STPurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\App\Libraries\ST\STPurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return STPurchaseRequest
     */
    public function purchaseRecurring(array $parameters = array())
    {
        return $this->createRequest('\App\Libraries\ST\STRecurringPurchaseRequest', $parameters);
    }

    public function combinePurchaseRequests(array $requests = array()) {

        $data = new \SimpleXMLElement('<?xml version="1.0"?><requestblock/>');
        $data->addAttribute('version', '3.67');
        $alias = $data->addChild('alias', $requests[0]->getUsername());



        foreach($requests as $request) {
            //print_r($request->getRequestBlock());exit();
            $this->sxml_append($data, $request->getRequestBlock());

        }

        return $data->asXML();
    }

    private function sxml_append(\SimpleXMLElement $to, \SimpleXMLElement $from) {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }



}