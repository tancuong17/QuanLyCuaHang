<?php
    class Price{
        public $id;
        public $idproduct;
        public $price;
        public $startDate;
        public $endDate;
        public $createDate;
        public function __construct($id, $idproduct, $price, $startDate, $endDate, $createDate)
        {
            $this->id = $id;
            $this->idproduct = $idproduct;
            $this->price = $price;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
            $this->createDate = $createDate;
        }
    }
?>