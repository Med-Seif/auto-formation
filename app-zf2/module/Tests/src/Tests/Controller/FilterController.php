<?php

namespace Tests\Controller;

/**
 * Description of FilterController
 *
 * @author Med_Seif <bromdhane@gail.com>
 */
class FilterController extends \Zend\Mvc\Controller\AbstractActionController {

    /**
     * Differents ways of calling a filter
     * @return boolean
     */
    public function indexAction() {
        $filter   = new \Zend\Filter\StringToLower();
        echo $filter->filter("ABCD") . "<br>";
        echo $filter("ABCD") . "<br>";
        echo \Zend\Filter\StaticFilter::execute("ABCD", 'stringtolower') . "<br>";
        $myfilter = new \Tests\Filter\ReverseString();
        //\Zend\Filter\StaticFilter::getPluginManager()->setInvokableClass('ReverseString', 'Tests\Filter\ReverseString'); // can be done in module.php
        //\Zend\Debug\Debug::dump(\Zend\Filter\StaticFilter::getPluginManager()->getRegisteredServices());
        echo \Zend\Filter\StaticFilter::execute("abcdefgh", 'ReverseString') . "<br>";
        echo $myfilter->filter("ijklmnop") . "<br>";
        echo $myfilter("123456789") . "<br>"; // must extend AbstractFilter
        return false;
    }

    public function inflectorAction() {
        $inflector = new \Zend\Filter\Inflector('<b>Welcome</b> :prefix :name');
        $inflector->setRules(array(
            ':name'  => array('StringToUpper'), // to apply filter u have to add the ":" and therfore u must define it in the input to be filtered
            'prefix' => 'Mr',
        ));
        echo $inflector->filter(array('name' => "B.Romdhane"));
        return false;
    }

    public function testAction() {
        $filter1 = new \Zend\Filter\Word\UnderscoreToCamelCase();
        $filter2 = new \Zend\Filter\Word\CamelCaseToUnderscore();
        echo $f1      = $filter1->filter("underscore_to_camel_case") . "<br>"; //returns "UnderscoreToCamelCase"
        echo $filter2->filter($f1) . "<br>";
        return false;
    }

    public function chainAction() {
        $chain = new \Zend\Filter\FilterChain();
        $chain->attachByName('StringToUpper',null,999);
        $chain->attach(new \Zend\Filter\StringToLower());
        //$chain->attach(new \Tests\Filter\ReverseString());
        $chain->getPluginManager()->setInvokableClass('ReverseString', 'Tests\Filter\ReverseString');
        $chain->attachByName('ReverseString');
        echo $chain->filter("path_to_country");
        return false;
    }
    public function aAction(){
        $f = $this->getServiceLocator()
                             ->get('FilterManager')
                             ->get('ReverseString');
        var_dump($f->filter('123'));
        return false;
    }

}
