<?php
namespace app\core\exception;

class NotFound extends \Exception{
    protected $code =404;
    protected $message = "Not Found";
}


?>