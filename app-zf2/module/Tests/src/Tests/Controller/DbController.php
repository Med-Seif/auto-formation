<?php

/**
 * Description of DbController
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Tests\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class DbController extends AbstractActionController {

    /**
     *
     * @return \Zend\Db\Adapter\Adapter
     */
    public function getAdapter() {
        /*
        $p = $this->getServiceLocator()->get('chartsData');
        $p->get('cnx_users');*/
        $p = $this->getServiceLocator()->get('charts')->get('users')->getData();
        var_dump($p);
        return $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    }

    public function indexAction() {

        return false;
    }

    public function e1Action() {
        $userTable = $this->getServiceLocator()->get('Admin\Model\UserTable');
        $gateway   = $userTable->getTableGateway();
        /* @var Zend\Db\ResultSet\ResultSet $data */
        $data      = $gateway->select(array('id' => 1));
        /** @var Admin\Model\User $data->current() */
        \Zend\Debug\Debug::dump($data->toArray(), "Query with TableGateway");
        \Zend\Debug\Debug::dump(get_class($data), "Result");
        return false;
    }

    public function e2Action() {
        $adapter = $this->getAdapter();
        /** @var Zend\Db\ResultSet\ResultSet */
        $data    = $adapter->query('SELECT * FROM `users` WHERE `username` = ?', array('admin')); // automatic quoting, parameter 2 specified => a resultSet is returned
        /* @var ArrayObject $data->current() */
        \Zend\Debug\Debug::dump($data->toArray(), "Query with adapetr");
        \Zend\Debug\Debug::dump(get_class($data), "Result");
        return false;
    }

    public function e3Action() {
        $adapter   = $this->getAdapter();
        /* @var Zend\Db\Adapter\Driver\Pdo\Statement */
        $statement = $adapter->createStatement('SELECT * FROM `users`', $optionalParameters);
        /* @var Zend\Db\Adapter\Driver\Pdo\Result */
        $result    = $statement->execute();
        \Zend\Debug\Debug::dump($statement, "Statment");
        \Zend\Debug\Debug::dump($result->current(), "Query with statment");
        \Zend\Debug\Debug::dump($result, "Result");
        return false;
    }

    public function e4Action() {
        $adapter   = $this->getAdapter();
        $platform  = $this->getAdapter()->getPlatform();
        /* @var Zend\Db\Adapter\Driver\StatementInterface */
        // notice that the second parameter in not defined, thus the returned result is Zend\Db\Adapter\Driver\Pdo\Statement
        $statement = $adapter->query("SELECT * FROM `users` WHERE " . $platform->quoteIdentifier('username') . " = " . $adapter->driver->formatParameterName('username'));
        $result    = $statement->execute(array('username' => 'admin'));
        \Zend\Debug\Debug::dump($statement, "Statement");
        /* @var Zend\Db\Adapter\Driver\Pdo\Result */
        \Zend\Debug\Debug::dump($result, "Result");
        /** @var Array $data->current() */
        \Zend\Debug\Debug::dump($result->current(), "result row");
        return false;
    }

    public function e5Action() {
        $adapter   = $this->getAdapter();
        $platform  = $this->getAdapter()->getPlatform();
        /** @var Zend\Db\ResultSet\ResultSet */
        $statement = $adapter->query('SELECT * FROM `users` WHERE `username` = ' . $platform->quoteValue('admin')); // manual quoting values
        $data      = $statement->execute();
        /* @var ArrayObject $data->current() */
        \Zend\Debug\Debug::dump($data->toArray(), "Query with adapetr");
        \Zend\Debug\Debug::dump(get_class($data), "Result");
        return false;
    }

    public function e6Action() {
        $adapter   = $this->getAdapter();
        $container = new \Zend\Db\Adapter\ParameterContainer();
        $container->setFromArray(array('username' => 'admin'));
        $container->offsetSet('id', 1, $container::TYPE_INTEGER);
        /* @var Zend\Db\Adapter\Driver\Pdo\Statement */
        $statement = $adapter->createStatement('SELECT * FROM `users` WHERE username = :username AND id = :id'); // automatic quoting id and username
        echo $statement->getSql();
        $statement->setParameterContainer($container);
        /* @var Zend\Db\Adapter\Driver\Pdo\Result */
        $result    = $statement->execute(); // query preparation with ->prepare() is done in execute()
        foreach ($result as $result) {
            var_dump($result);
        }
        return false;
    }

    public function e7Action() {
        $adapter = $this->getAdapter();
        $res     = $adapter->query('SELECT * FROM `users` WHERE id = 1', $adapter::QUERY_MODE_EXECUTE); // returns Statement if the second param was not specified
        var_dump($res->current());
        return false;
    }

    public function e8Action() {
        $adapter  = $this->getAdapter();
        $platform = $this->getAdapter()->getPlatform();
        $res      = $adapter->query('SELECT * FROM `users` WHERE username = ? and id = ?', array('admin', 1)); // return ResultSet
        $res      = $adapter->query('SELECT * FROM `users` WHERE username = :u and id = :i', array('u' => 'admin', 'i' => 1)); // return ResultSet
        var_dump($res->toArray(), get_class($res));
        // without adding the second parameter this will return a statment
        $res2     = $adapter->query('SELECT * FROM `users` WHERE `username` = ' . $platform->quoteValue('admin'), $adapter::QUERY_MODE_EXECUTE);
        var_dump($res2->toArray(), get_class($res2));
        return false;
    }

    public function e9Action() {
        $adapter = $this->getAdapter();
        // returns ResultSet but when using createStatement instead of query it returns ResultSet
        $res     = $adapter->createStatement('SELECT * FROM `users` WHERE username = ? and id = ?', array('admin', 1));
        $data    = $res->execute();
        var_dump($data->current(), get_class($data));
        return false;
    }

    /**
     * Convert a Zend\Db\Adapter\Driver\ResultInterface to Zend\Db\ResultSet\ResultSetInterface
     * @return boolean
     */
    public function e10Action() {
        $adapter   = $this->getAdapter();
        // returns Statement but when using query instead of create Statment it returns ResultSet
        $res       = $adapter->createStatement('SELECT * FROM `users` WHERE username Like ?', array('%a%'));
        $data      = $res->execute();
        $resultSet = new \Zend\Db\ResultSet\ResultSet();
        $resultSet->initialize($data);
        var_dump(/* Return ArrayObject() */$resultSet->current(), /* Returns array() */ $data->current(), get_class($data), get_class($resultSet));
        return false;
    }

    /**
     * Test Zend\Db\ResultSet\HydratingResultSet
     * @return boolean
     */
    public function e11Action() {
        $adapter   = $this->getAdapter();
        $stmt      = $adapter->createStatement('SELECT id as myid,username as myusername FROM `users` WHERE username = ? and id = ?', array('admin', 1));
        $result    = $stmt->execute();
        $resultSet = new \Zend\Db\ResultSet\HydratingResultSet(new \Zend\Stdlib\Hydrator\Reflection, new myuser());
        $resultSet->initialize($result);
        var_dump($resultSet->current(), $resultSet->current()->getId());
        return false;
    }

    /**
     * Testing Zend\Db\Sql
     */
    public function e12Action() {
        $adapter = $this->getAdapter();
        // !! $stmtcontainer = new \Zend\Db\Adapter\StatementContainer();
        $stmt    = $adapter->createStatement('SELECT id as myid,username as myusername FROM `users` WHERE username = ? and id = ?'); // automatic quoting
        var_dump(get_class($stmt));
        $stmt->setParameterContainer(new \Zend\Db\Adapter\ParameterContainer(array(0 => "adm'in", 1 => 1)));
        $res     = $stmt->execute();
        var_dump($res->current());
        return false;
    }

    public function e13Action() {

        $sql          = new \Zend\Db\Sql\Sql($this->getAdapter());
        $sql->setTable('products');
        $select       = $sql->select()->limit(5);
        $select->where(array('id ' => "e'e")); // automatic quoting
        $statement    = $sql->prepareStatementForSqlObject($select);
        $results      = $statement->execute();
        $selectString = $sql->getSqlStringForSqlObject($select);
        \Zend\Debug\Debug::dump($selectString, "query");
        foreach ($results as $row) {
            echo serialize($results->current()) . "<br />";
        }
        return false;
    }

    /**
     * Deep tests of quoting
     */
    public function e14Action() {
        $adapter = $this->getAdapter();
        $select  = new \Zend\Db\Sql\Select('products');
        $select->where(new \Zend\Db\Sql\Predicate\In('supplier_id', array("1'", 2, 3, 4)));

        $sql     = new \Zend\Db\Sql\Sql($adapter);
        $stmt    = $sql->prepareStatementForSqlObject($select);
        echo $stmt->getSql();
        $results = $stmt->execute();
        var_dump($results);
        return false;
    }

}

class myuser {

    private $myusername;
    private $myid;

    public function getId() {
        return $this->myusername;
    }

    public function getUsername() {
        return $this->myid;
    }

}
