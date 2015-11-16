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
     * @ORM\Column(type="string")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="auths")
     * @ORM\JoinColumn(name="iduser", referencedColumnName="id",nullable=false)
     */
    protected $user;

    /**
     * @ORM\Column(type="datetime",nullable=false)
     */
    protected $connectTime;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $disconnectTime;

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
     * Set connectTime
     *
     * @param \DateTime $connectTime
     *
     * @return Auth
     */
    public function setConnectTime($connectTime) {
        $this->connectTime = $connectTime;

        return $this;
    }

    /**
     * Get connectTime
     *
     * @return \DateTime
     */
    public function getConnectTime() {
        return $this->connectTime;
    }

    /**
     * Set disconnectTime
     *
     * @param \DateTime $disconnectTime
     *
     * @return Auth
     */
    public function setDisconnectTime($disconnectTime) {
        $this->disconnectTime = $disconnectTime;

        return $this;
    }

    /**
     * Get disconnectTime
     *
     * @return \DateTime
     */
    public function getDisconnectTime() {
        return $this->disconnectTime;
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

    public function injectObjectManager(ObjectManager $objectManager, ClassMetadata $classMetadata) {
        $this->em = $objectManager;
    }

}
