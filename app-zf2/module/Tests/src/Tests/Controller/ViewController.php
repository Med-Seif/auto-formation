<?php

namespace Tests\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\ViewEvent;

class ViewController extends AbstractActionController {

    public $viewEvent;

    public function indexAction() {
        $view       = new ViewModel();
        $view->setTemplate("tests/view-scripts/index");
        $viewShared = new ViewModel();
        $viewShared->setTemplate("tests/view-scripts/shared");
        $viewShared->setVariables(array(
            'title' => 'Chakala',
            'text'  => 'pataka'
        ));
        $view->addChild($viewShared, 'shared');
        return $view;
    }

    public function v1Action() {
        $view = new ViewModel();
        $view->setTemplate("tests/view-scripts/v1");
        $view->setCaptureTo('persocontent');
        $view->setTerminal(true);
        return $view;
    }

    /**
     * Testing add another path for views in application.config.php
     */
    public function v2Action() {
        $view = new ViewModel();
        $view->setVariable("data", "Chakala");
        return $view;
    }

    /**
     * Working with view events
     */
    public function VieweventAction() {
        // $viewModel = new ViewModel(array('a' => 'Foo'));
        /* @var $v \Zend\View\View */
        $v = $this->getServiceLocator()->get('Zend\View\View');
        $v->getEventManager()->attach(ViewEvent::EVENT_RENDERER, array($this, 'rendererEvent'));
        $v->getEventManager()->attach(ViewEvent::EVENT_RENDERER_POST, array($this, 'rendererPostEvent'));
        $v->getEventManager()->attach(ViewEvent::EVENT_RESPONSE, array($this, 'responseEvent'));
        return array(
            'a' => 'Foo'
        );
    }

    /**
     *
     * @param \Zend\View\ViewEvent $e
     */
    public function rendererEvent($e) {
        // this function is executed twice because renderer will render the view script in addition to the layout script,(disable layout to see the difference)
        $e->getModel()->setVariable('c', "Lorem");
    }

    /**
     *
     * @param \Zend\View\ViewEvent $e
     */
    public function rendererPostEvent($e) {
        // this function is executed twice because renderer will render the view script in addition to the layout script,(disable layout to see the difference)
        $e->getModel()->setVariable('b', "Bar");
    }

    /**
     *
     * @param \Zend\View\ViewEvent $e
     */
    public function responseEvent($e) {
        $e->getModel()->setVariable('d', "Ipsur"); // no effect because the result is already built
        $e->getRenderer()->headTitle(__FUNCTION__); // headTitle is a view helper and all pre-built view helpers are registered with the PhpRenderer
        echo "<pre>" . htmlentities($e->getResult()) . "</pre>";
        $e->setResult($e->getResult() . '<nav class="navbar navbar-inverse navbar-fixed-top"> <p class="navbar-text">This toolbar was injected using the view event and the <b>setResult</b> Method</p></nav>');
    }

    /**
     * Testing view helpers : Register a helper manually in the PhpRenderer
     */
    public function vhAction() {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        $helper = new \Tests\ViewHelpers\MyViewHelper();
        $renderer->getHelperPluginManager()->setService('MyViewHelper',$helper);

    }

    public function responseAction() {
        $this->response->setContent("Content linked manually to response object");
        return $this->response;
    }

}
