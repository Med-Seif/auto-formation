<?php

/**
 * Description of Listener
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Entity\Listener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class EntityListener {

    public function preUpdate($entity, PreUpdateEventArgs $event) {

    }

    public function postUpdate($entity, LifecycleEventArgs $args) {

    }

    public function postRemove() {

    }

    public function preRemove() {

    }

    public function prePersist() {

    }

    public function postPersist() {

    }

}
