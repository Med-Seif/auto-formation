<?php
namespace Tests\Models;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

class DateStrategy implements StrategyInterface {

    public function extract($value) {
        \Zend\Debug\Debug::dump(__CLASS__ .'::' . __FUNCTION__);
        return $value->format("d/m/Y");
    }

    public function hydrate($value) {
        \Zend\Debug\Debug::dump(__CLASS__ .'::' . __FUNCTION__);
        return \DateTime::createFromFormat("d/m/Y", $value);
    }

}
