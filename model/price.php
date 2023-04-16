<?php
    class Price{
        public $idproduct;
        public $price;
        public $startDate;
        public $endDate;
        public $createDate;
        public function __construct($idproduct, $price, $startDate, $endDate, $createDate)
        {
            $this->idproduct = $idproduct;
            $this->price = $price;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
            $this->createDate = $createDate;
        }
    }
?>