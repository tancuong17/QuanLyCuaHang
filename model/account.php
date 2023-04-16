<?php
    class Account{
        public $username;
        public $name;
        public $password;
        public $createDate;
        public function __construct($username, $name, $password, $createDate) {
            $this->username = $username;
            $this->name = $name;
            $this->password = $password;
            $this->createDate = $createDate;
        }
        public function getUsername()
        {
            return $this->username;
        }
        public function getName()
        {
            return $this->name;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function getCreateDate()
        {
            return $this->createDate;
        }
    }
?>