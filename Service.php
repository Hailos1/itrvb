<?php
namespace laba1{

    use DateTime;

    class Service extends Product{
        public function __construct(int $id, 
        string $name, 
        float $price, 
        string $description,
        public $endDate){
            parent::__construct($id, $name, $price, $description);
            $endDate->modify('+10 days');
            $this->endDate = $endDate;
        }
    }
}
?>