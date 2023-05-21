<?php
    class Account{
        public $username;
        public $password;
        public $name;
        public $role;
        public $createDate;
        public function __construct($username, $name, $password, $role, $createDate) {
            $this->username = $username;
            $this->password = $password;
            $this->name = $name;
            $this->role = $role;
            $this->createDate = $createDate;
        }
        public function getUsername()
        {
            return $this->username;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function getName()
        {
            return $this->name;
        }
        public function getRole()
        {
            return $this->role;
        }
        public function getCreateDate()
        {
            return $this->createDate;
        }
    }
?>