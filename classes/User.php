<?php
class User {
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $created_at;

    public function __construct($name = "", $email = "", $password = "", $role = "") {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getRole() {
        return $this->role;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
}