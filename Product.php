<?php
namespace laba1{
    class Product{
        public function __construct(public int $id, 
        public string $name, 
        public float $price, 
        public string $description){
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->description = $description;
        }
    }
}
?>