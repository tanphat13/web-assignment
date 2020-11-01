<?php
namespace app\core;
use app\core\Application;
use app\core\middleware\BaseMiddleware;

class Controller{

    public string $layout = 'main_layout';
    /**
     * @var app\core\middlewares\BaseMiddleware[];
     */
    public array  $middlewares = []; 
    public string $action = '';
    public function setLayout($layout){
        $this->layout = $layout;
    }
    
    public function render($view,$param=[]){
        return Application::$app->router->renderViews($view,$param);
    } 
    public function registerMiddleware(BaseMiddleware $middleware){
        $this->middlewares[] = $middleware;
    }
    public function getMiddleware (){
        return $this->middlewares;
    }
}


?>