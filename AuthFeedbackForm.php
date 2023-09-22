<?php
namespace laba1{
    //форма для авторизованного пользователя
    class AuthFeedbackForm extends FeedbackForm{  
        public function __construct($name, $email, $message, public User $user) {
            parent::__construct($name, $email, $message);
            $this->user = $user;
        }       
    }
}
?>