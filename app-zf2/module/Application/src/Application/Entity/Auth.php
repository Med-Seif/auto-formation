<?php

/**
 * Description of Auth
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Entity;

use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectManagerAware;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="_auth")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\AuthRepository")
 */
Class Auth implements ObjectManagerAware {

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User",inversedBy="auths",cascade={"persist"})
     * @ORM\JoinColumn(name="iduser", referencedColumnName="id",nullable=false)
     */
    protected $user;

    /**
     * @ORM\Column(type="integer",nullable=false,options={"default" = 0})
     */
    protected $count;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $operationTime;

    /**
     * @ORM\Column(type="integer",length=1,nullable=false,options={"default" = 0})
     */
    protected $connected;

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return Auth
     */
    public function setUser(\Application\Entity\User $user) {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set operationTime
     *
     * @param \DateTime $operationTime
     *
     * @return Auth
     */
    public function setOperationTime($operationTime) {
        $this->operationTime = $operationTime;

        return $this;
    }

    /**
     * Get operationTime
     *
     * @return \DateTime
     */
    public function getOperationTime() {
        return $this->operationTime;
    }

    /**
     * Set connected
     *
     * @param integer $connected
     *
     * @return Auth
     */
    public function setConnected($connected) {
        $this->connected = $connected;

        return $this;
    }

    /**
     * Get connected
     *
     * @return integer
     */
    public function getConnected() {
        return $this->connected;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount() {
        return $this->count;
    }

    /**
     * Set count
     *
     * @param boolean $flag
     * @return Auth
     */
    public function setCount($flag) {
        if ($flag) {
            $this->count++;
        }
        return $this;
    }

    public function injectObjectManager(ObjectManager $objectManager, ClassMetadata $classMetadata) {
        $this->em = $objectManager;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
