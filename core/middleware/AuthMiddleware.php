<?php

namespace app\core\middleware;
use app\core\Application;
use app\core\exception\Forbidden;

class AuthMiddleware extends BaseMiddleware{
    public array $actions = [];
    public function __construct(array $actions = []){
        $this->actions = $actions;
    }

    public function execute() {
        // echo "<pre>";
        // echo var_dump($this->actions);
        // echo "</pre>";
        // exit;
        if(Application::isGuest()){
            if(empty($this->actions) || in_array(Application::$app->controller->action,$this->actions)){
                throw new Forbidden();
            }
        }
    }
}


?>