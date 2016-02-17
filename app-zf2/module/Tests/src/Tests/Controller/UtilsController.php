<?php

/**
 * Description of UtilsController
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Tests\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class UtilsController extends AbstractActionController {

    /**
     * Testing the filesystem cache adapter
     *
     * @return boolean
     */
    public function indexAction() {
        $conf = $this->serviceLocator->get('seif');
        \Zend\Debug\Debug::dump($conf);
        return false;
    }

    /**
     * Testing logger to a stream and a db table
     *
     * @return boolean
     */
    public function loggerAction() {
        $logger     = new \Zend\Log\Logger();
        $writerFile = new \Zend\Log\Writer\Stream(APPLICATION_PATH . 'logs/errors.log');
        $db         = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $mapping    = array(
            'timestamp' => 'date',
            'priority'  => 'type',
            'message'   => 'event'
        );
        $writerDb   = new \Zend\Log\Writer\Db($db, '_log', $mapping);
        $logger->addWriter($writerFile);
        $logger->addWriter($writerDb);
        $logger->info("Test");
        return false;
    }

    /**
     * Testing mail to a file
     */
    public function mailAction() {
        $transport = new \Zend\Mail\Transport\File();

        $options = new \Zend\Mail\Transport\FileOptions();
        $options->setPath(APPLICATION_PATH . 'logs/mails/');
        $transport->setOptions($options);
        $mail    = new \Zend\Mail\Message();
        $mail->setBody("Mail de test");
        $mail->addFrom("bromdhane@gmail.com");
        $mail->addTo("seif@bilog.fr");
        $transport->send($mail);
        return false;
    }

    public function hydratorAction() {
        /**
         * Hydrator instanciation
         */
        //$hydrator  = new \Zend\Stdlib\Hydrator\ArraySerializable();
        //$hydrator  = new \Zend\Stdlib\Hydrator\ObjectProperty;
        //$hydrator  = new \Zend\Stdlib\Hydrator\ClassMethods(FALSE);
        $hydrator  = new \Zend\Stdlib\Hydrator\Reflection();
        //$hydrator->addStrategy('birthDate', new \Tests\Models\DateStrategy());
        /**
         * Adding filter(s)
         */
        //$hydrator->addFilter('get',new \Zend\Stdlib\Hydrator\Filter\GetFilter());
        //$composite = new \Zend\Stdlib\Hydrator\Filter\FilterComposite();
        //$composite->addFilter('filterGet', new \Zend\Stdlib\Hydrator\Filter\GetFilter());
        //$composite->addFilter('filter1', new \Zend\Stdlib\Hydrator\Filter\MethodMatchFilter('getId',false));
        //$composite->addFilter('filter1', new \Zend\Stdlib\Hydrator\Filter\MethodMatchFilter('getId',false));
        //$composite->addFilter('event_manager', new \Zend\Stdlib\Hydrator\Filter\MethodMatchFilter('getEventManager'));
        $hydrator->addFilter('get', new \Zend\Stdlib\Hydrator\Filter\getFilter());
        /**
         * Extraction
         */
        \Zend\Debug\Debug::dump(get_class($hydrator), 'HYDRATOR TYPE');
        $person    = new \Tests\Models\Person();
        $arrPerson = $hydrator->extract($person);
        \Zend\Debug\Debug::dump($arrPerson, 'EXTRACT : OBJECT => ARRAY');
        /**
         * Hydration
         */
        $hydrator->hydrate(array('id' => 'EEEEE', 'birthDate' => '12/01/2011', 'name' => 'B'), $person);
        \Zend\Debug\Debug::dump($person, 'HYDRATE : ARRAY => OBJECT');
        return false;
    }

    /**
     * Reading from session set up previously
     * @return boolean
     */
    public function sessionAction() {
        $session        = new \Zend\Session\Container('MyContainer');
        $o              = new \stdClass();
        $o->p1          = "lorem";
        $o->p2          = "ipsur";
        $session->data  = $o;
        $session2       = new \Zend\Session\Container('MyContainer2');
        $session2->data = array('cc');
        return false;
    }

    /**
     * Reading from session set up previously
     * @return boolean
     */
    public function session1Action() {
        $session  = new \Zend\Session\Container('MyContainer');
        \Zend\Debug\Debug::dump($session->data);
        $session2 = new \Zend\Session\Container('MyContainer2');
        \Zend\Debug\Debug::dump($session2->data);
        \Zend\Debug\Debug::dump($_SESSION);
        \Zend\Debug\Debug::dump($session->getManager()->getStorage());
        return false;
    }

}
