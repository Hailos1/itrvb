<?php
namespace laba1{
    class Cart{
        public function __construct(public int $id,public Product ...$products){
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