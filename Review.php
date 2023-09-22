<?php
namespace laba1{

    use Exception;

    class Review{
        public function __construct(public int $id, 
        public Product $product, 
        public string $review,
        public int $rating){
            $this->id = $id;
            $this->product = $product;
            $this->review = $review;
            if ($rating >= 0 && $rating <=10){
                $this->rating = $rating;
            }
            else{
                throw new Exception("рейтинг должен быть в диапозоне от 0 до 10");
            }
        }
    }
}
?>