<?php
    class Product{
        public $id;
        public $name;
        public $image;
        public $price;
        public $createDate;
        public $updateDate;
        public function __construct($id, $name, $image, $price, $createDate, $updateDate){
            $this->id = $id;
            $this->name = $name;
            $this->image = $image;
            $this->price = $price;
            $this->createDate = $createDate;
            $this->updateDate = $updateDate;
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
        public function getPrice()
        {
            return $this->price;
        }
        public function getCreateDate()
        {
            return $this->createDate;
        }
        public function getUpdateDate()
        {
            return $this->updateDate;
        }
    }
?>