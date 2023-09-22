<?php
namespace laba2{
    class DigitalProduct extends Product{
        function getFinalPrice(){
            return $this->price / 2;
        }
    }
}
?>