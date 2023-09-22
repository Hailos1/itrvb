<?php
namespace laba1{
    class User{
        public function __construct(public int $id, 
        public string $name, 
        public string $lastName,
        public string $email,
        public Cart $cart,
        public int $age){
            $this->id = $id;
            $this->name = $name;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->cart = $cart;
            $this->age = $age;
        }
    }
}
?>