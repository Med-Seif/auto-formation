<?php

/**
 * Description of MyObject
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Tests\Models;

use Zend\Debug\Debug;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;

class Person {


    public $birthDate;
    public $name;
    public $Id;

    public function __construct() {
        Debug::dump(__CLASS__ . '::' . __FUNCTION__);
        $this->id        = 12324532;
        $this->name      = "ABC";
        $this->birthDate = new \DateTime();
    }

    /**
     * Used in Extraction
     * @return type
     */
    public function getArrayCopy() {
        Debug::dump(__CLASS__ . '::' . __FUNCTION__);
        return array(
            'id'        => $this->id,
            'birthDate' => $this->birthDate,
            'name'      => $this->name);
    }

    /**
     * Used in Hydration
     *
     * @param array $data
     */
    public function exchangeArray(Array $data) {
        Debug::dump(__CLASS__ . '::' . __FUNCTION__);
        $this->id        = $data['id'];
        $this->birthDate = $data['birthDate'];
        $this->name      = $data['name'];
    }

    /**
     * Used in Hydration
     *
     * @param array $data
     */
    public function populate(Array $data) {
        Debug::dump(__CLASS__ . '::' . __FUNCTION__);
        $this->id        = $data['id'];
        $this->birthDate = $data['birthDate'];
        $this->name      = $data['name'];
    }

    public function IsName($name) {
        Debug::dump(__CLASS__ . '::' . __FUNCTION__);
        $this->name = $name;
    }

    public function setBirthDate($birthDate) {
        Debug::dump(__CLASS__ . '::' . __FUNCTION__);
        $this->birthDate = $birthDate;
    }

    public function getId() {
        Debug::dump(__CLASS__ . '::' . __FUNCTION__);
    }

    public function getName() {
        Debug::dump(__CLASS__ . '::' . __FUNCTION__);
        return $this->name;
    }

    public function getBirthDate() {
        Debug::dump(__CLASS__ . '::' . __FUNCTION__);
        return $this->birthDate;
    }

}
