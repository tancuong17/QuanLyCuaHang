<?php
    class Product{
        public $id;
        public $name;
        public $image;
        public $createDate;
        public function __construct($id, $name, $image, $createDate){
            $this->id = $id;
            $this->name = $name;
            $this->image = $image;
            $this->createDate = $createDate;
        }
        public function getId()
        {
            return $this->id;
        }
        public function getName()
        {
            return $this->name;
        }
        public function getImage()
        {
            return $this->image;
        }
        public function getCreateDate()
        {
            return $this->createDate;
        }
    }
?>