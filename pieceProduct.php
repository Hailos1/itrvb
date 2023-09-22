<?php
namespace laba2{
    class PieceProduct extends Product{
        public int $pieces;
        function __construct($name, $desc, $price, $pieces){
            parent::__construct($name, $desc, $price);
            $this->pieces = $pieces;
        }

        function getFinalPrice(){
            return $this->price * $this->pieces;
        }
    }
}
?>