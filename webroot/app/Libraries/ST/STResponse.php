<?php

namespace App\Libraries\ST;


use Illuminate\Support\Facades\Gate;
use Omnipay\SecureTrading\Message\Response;

class STResponse extends Response {

    public function isSuccessful()
    {
        return $this->getSettleStatus() !== 3;
    }

    // todo : refactor this mess
    public function getParsedArray() {
        $rsp = $this->getData();
        preg_match('/<responseblock version="3.67">(.*?)<\/responseblock>/s', $rsp, $matches);

        if(isset($matches[1])) {
            $rspArray = simplexml_load_string('<responseblock version="3.67">' . $matches[1] . '</responseblock>');
            return $rspArray;
        }
        else return [];
    }

    public function getRealMessage () {

        $data = $this->getParsedArray();

        if($data && isset($data->response->error->message)) {

            return (string) $data->response->error->message;
        }

        return $this->getMessage();
    }

<<<<<<< HEAD
    public function getRealCode () {

        $data = $this->getParsedArray();

        if($data && isset($data->response->error->code)) {

            return (int) $data->response->error->code;
        }

        return $this->getCode();
    }

=======
>>>>>>> test
}
