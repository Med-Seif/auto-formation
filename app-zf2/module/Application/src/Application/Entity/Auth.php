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
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue (strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",nullable=false)
     */
    protected $sessionId;

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="auths",cascade={"persist"})
     * @ORM\JoinColumn(name="iduser", referencedColumnName="id",nullable=false)
     */
    protected $user;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $operationTime;

    /**
     * @ORM\Column(type="integer",length=1,nullable=false,options={"default" = 0})
     */
    protected $connected;

    /**
     * Set id
     *
     * @param string $id
     *
     * @return Auth
     */
    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId() {
        return $this->id;
    }

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
     * Get sessionId
     *
     * @return string
     */
    public function getSessionId() {
        return $this->sessionId;
    }

    /**
     * Set sessionId
     *
     * @param string $sessionId
     * @return Auth
     */
    public function setSessionId($sessionId) {
        $this->sessionId = $sessionId;
        return $this;
    }

    public function injectObjectManager(ObjectManager $objectManager, ClassMetadata $classMetadata) {
        $this->em = $objectManager;
    }

}
