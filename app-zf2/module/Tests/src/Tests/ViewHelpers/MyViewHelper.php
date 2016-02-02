<?php
namespace Tests\ViewHelpers;

use Zend\View\Helper\HelperInterface;

class MyViewHelper implements HelperInterface
{
    public function generateCode(){
        return "abcd243ds";
    }

    public function getView() {

    }

    public function setView(\Zend\View\Renderer\RendererInterface $view) {

    }

}