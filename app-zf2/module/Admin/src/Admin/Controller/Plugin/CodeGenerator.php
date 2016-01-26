<?php

/**
 * Description of CodeGenerator
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Admin\Controller\Plugin;

class CodeGenerator extends \Zend\Mvc\Controller\Plugin\AbstractPlugin {
    /**
     * used in Tests\Index\mvc
     */
    public function generate(){
        return "abcdef";
    }

}
