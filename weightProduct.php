<?php
namespace laba2{
    class WeightProduct extends Product{
        public float $weight;
        function __construct($name, $desc, $price, $weight){
            parent::__construct($name, $desc, $price);
            $this->weight = $weight;
        }

        function getFinalPrice(){
            return $this->price * $this->weight;
        }
    }
}
?>