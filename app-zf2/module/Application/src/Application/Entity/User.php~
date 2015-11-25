<?php

/**
 * Description of User
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\UserRepository")
 */
Class User {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=45,nullable=false)
     */
    protected $username;

    /**
     * @ORM\Column(type="string",length=45,nullable=false)
     */
    protected $email;

    /**
     * @ORM\Column(type="integer",length=1,nullable=false)
     */
    protected $role;

    /**
     * @ORM\Column(type="string",length=45,nullable=false)
     */
    protected $password;

    /**
     * @ORM\OneToMany(targetEntity="Auth", mappedBy="user")
     */
    protected $auths;

    /**
     * Constructor
     */
    public function __construct() {
        $this->auths = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set role
     *
     * @param integer $role
     *
     * @return User
     */
    public function setRole($role) {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return integer
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Add auth
     *
     * @param \Application\Entity\Auth $auth
     *
     * @return User
     */
    public function addAuth(\Application\Entity\Auth $auth) {
        $this->auths[] = $auth;

        return $this;
    }

    /**
     * Remove auth
     *
     * @param \Application\Entity\Auth $auth
     */
    public function removeAuth(\Application\Entity\Auth $auth) {
        $this->auths->removeElement($auth);
    }

    /**
     * Get auths
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuths() {
        return $this->auths;
    }

}
