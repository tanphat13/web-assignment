<?php
namespace app\core;

class Response {
    public function setStatusCode(int $code){
        echo var_dump($code);
        exit;
        http_response_code($code);
    }
    public function redirect($url,$delay=0){
        header("Location: $url");
    }
}



?>