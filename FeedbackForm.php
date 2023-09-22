<?php
namespace laba1{
    //форма специально не привяязана к определённому пользователю.
    class FeedbackForm {  
        public function __construct(public string $name, public string $email, public string $message) {
            $this->name = $name;
            $this->email = $email;
            $this->message = $message;
        }       
    }
}
?>