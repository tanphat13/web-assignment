<?php
    namespace app\core\exception;
    class Forbidden extends \Exception {
        protected $code = 403;
        protected $message = 'You are not able to access this page!';
        // public function getCode(){
        //     return $this->code;
        // } 
        // public function getMessage(){
        //     return $this->message;
        // }
    }

?>