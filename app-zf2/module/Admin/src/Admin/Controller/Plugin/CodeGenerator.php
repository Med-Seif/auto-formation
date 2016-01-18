<?php

/**
 * Description of CodeGenerator
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Admin\Controller\Plugin;

class CodeGenerator extends \Zend\Mvc\Controller\Plugin\AbstractPlugin {
    public function generate(){
        return "abcdef";
    }
    public function __invoke(){
        return "123456798";
    }
}
