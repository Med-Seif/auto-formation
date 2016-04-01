<?php

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;
use Admin\Model\User;

class UserTable {

    public $tableGateway;

    public function __construct($dbAdapter) {
        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new User()); // Object user must implement exchangeArray method
        //$features           = new \Zend\Db\TableGateway\Feature\FeatureSet();
        //$features->addFeature(new \Zend\Db\TableGateway\Feature\MetadataFeature());
        //$features->addFeature(new \Zend\Db\TableGateway\Feature\RowGatewayFeature('id'));
        $tableGateway       = new \Zend\Db\TableGateway\TableGateway('users', $dbAdapter, null, $resultSetPrototype);
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        return $resultSet = $this->tableGateway->select();
    }

    public function getUser($id) {
        $id     = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row    = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveUser(User $user) {
        $id = (int) $user->id;
        if ($id == 0) {
            return $this->tableGateway->insert($user->getArrayCopy());
        } else {
            if ($this->getUser($id)) {
                return $this->tableGateway->update($user->getArrayCopy(), array('id' => $id));
            } else {
                throw new \Exception('User id does not exist');
            }
        }
    }

    public function deleteAlbum($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    public function getTableGateway() {
        return $this->tableGateway;
    }

}
