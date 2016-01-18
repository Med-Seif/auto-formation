<?php

namespace Admin\Model;

class User {

    public $id;
    public $username;
    public $email;
    public $role;
    public $password;
    public function exchangeArray($data) {
        $this->id       = (!empty($data['id'])) ? $data['id'] : null;
        $this->username = (!empty($data['username'])) ? $data['username'] : null;
        $this->email    = (!empty($data['email'])) ? $data['email'] : null;
        $this->role     = (!empty($data['role'])) ? $data['role'] : null;
        $this->password = (!empty($data['password'])) ? md5($data['password']) : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
