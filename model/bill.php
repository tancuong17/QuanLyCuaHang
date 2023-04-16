<?php
    class Bill{
        public $id;
        public $username;
        public $createDate;
        public function __construct($id, $username, $createDate)
        {
            $this->id = $id;
            $this->username = $username;
            $this->createDate = $createDate;
        }
        public function getId()
        {
            return $this->id;
        }
        public function getUsername()
        {
            return $this->username;
        }
        public function getCreateDate()
        {
            return $this->createDate;
        }
    }
?>