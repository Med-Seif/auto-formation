<?php

namespace Admin\Model;

class User {

    public $id;
    public $username;
    public $email;
    public $role;
    public $password;

    /**
     *
     * @param Array $data
     * @return \Admin\Model\User
     */
    public function exchangeArray($data) {
        $this->id       = (!empty($data['id'])) ? $data['id'] : null;
        $this->username = (!empty($data['username'])) ? $data['username'] : null;
        $this->email    = (!empty($data['email'])) ? $data['email'] : null;
        $this->role     = (!empty($data['role'])) ? $data['role'] : null;
        $this->password = (!empty($data['password'])) ? md5($data['password']) : null;
    }
    /**
     *
     * @return Array
     */
    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

}
