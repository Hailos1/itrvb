<?php
namespace laba1{
    class Cart{
        public int $id;
        public array $products;
    
        public function __construct(int $id, Product ...$products) {
            $this->id = $id;
            $this->products = $products;
        }

        public function addProduct($product) {
            $this->products = $product;
        }

        public function removeProduct($product) {
            $index = array_search($product, $this->products);
            if ($index !== false) {
                unset($this->products[$index]);
            }
        }
    }
}
?>