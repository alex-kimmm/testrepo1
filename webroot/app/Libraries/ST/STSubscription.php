<?php
/**
 * Created by PhpStorm.
 * User: vitalie
 * Date: 13/04/2016
 * Time: 15:33
 */

namespace App\Libraries\ST;


use Omnipay\Common\Helper;
use Symfony\Component\HttpFoundation\ParameterBag;

class STSubscription {

    private $unit;
    private $frequency;
    private $finalnumber;
    private $begindate;
    private $number;


    /**
     * Create a new STSubscription object using the specified parameters
     *
     * @param array $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }

    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     * @return STSubscription provides a fluent interface.
     */
    public function initialize($parameters = null)
    {
        $this->parameters = new ParameterBag();

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * @param mixed $begindate
     */
    public function setBegindate($begindate)
    {
        $this->begindate = $begindate;
    }

    /**
     * @return mixed
     */
    public function getBegindate()
    {
        return $this->begindate;
    }

    /**
     * @param mixed $finalnumber
     */
    public function setFinalnumber($finalnumber)
    {
        $this->finalnumber = $finalnumber;
    }

    /**
     * @return mixed
     */
    public function getFinalnumber()
    {
        return $this->finalnumber;
    }

    /**
     * @param mixed $frequency
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    }

    /**
     * @return mixed
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param mixed $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param mixed $subscriptionnumber
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }






} 