<?php
namespace laba2{
    abstract class Product{
        public string $name;
        public string $desc;
        protected float $price;
        protected float $income; //для подсчёта дохода, но из задания не понял 

        public function __construct($name, $desc, $price){
            $this->name = $name;
            $this->desc = $desc;
            $this->price = $price;
        }

        abstract public function getFinalPrice(); 
    }
}
?>