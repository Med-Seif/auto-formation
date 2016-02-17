<?php

/**
 * Description of MyAppCache
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Tests\Cache;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;

class MyAppCacheAdapter extends \Zend\Cache\Storage\Adapter\AbstractAdapter {

    public function __construct(Adapter $db) {
        $this->tableGateway = $cacheTable         = new TableGateway('_cache', $db);
    }

    protected function internalGetItem(&$normalizedKey, &$success = null, &$casToken = null) {
        return "not implemented yet by seif";
    }

    protected function internalRemoveItem(&$normalizedKey) {

    }

    protected function internalSetItem(&$normalizedKey, &$value) {
        $this->tableGateway->insert(array('key' => $normalizedKey, 'value' => $value));
    }

}
