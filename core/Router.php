<?php
    namespace app\core;
    use app\core\Controller;
    use app\controller\AdminController; 
    use app\core\exception\Forbidden;
    use app\core\Session;
    use app\core\exception\NotFound;

class Router{
    public Request $request;
    public Response $response;
    public Session $session;
    protected array $routes = [];
    // public $adminController;
    // public Controller $controller;
    public function __construct(Request $request, Response $response)
    {
        $this->session = Application::$app->session;
        //$this->adminController = AdminController::$test;
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path,$callback){
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
    public function resolve (){
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        // echo "<pre>";
        // echo var_dump($path);
        // echo var_dump($method);
        // echo "</pre>";
        // exit;
        $userRole = $this->session->get('authorization');
        $roleList = $callback[2] ?? [];
        if(in_array($userRole,$roleList)|| !$roleList){
             
            if ($callback === false) {
                Application::$app->response->setStatusCode(404);
               
                throw new NotFound();
            } else if (is_string($callback)) {
                return $this->renderViews($callback);
            } else if (is_array($callback)) {
                //echo  $callback[0];
                /** @var app\core\Controller $controller */            
                $controller = new $callback[0]();
                Application::$app->controller = $controller;
                $controller->action = $callback[1];
                $callback[0] = $controller;
              
                //exit;
                foreach ($controller->getMiddleware() as $middleware) {
                    $middleware->execute();
                }
                // echo "beforece exit";
                // exit;
            }
            return  call_user_func($callback, $this->request, $this->response);
        }else{
            throw new Forbidden();
        }
    }

    public function renderViews($view,$param = []){ 
        $layoutContent = $this->layoutContent($param);
        $viewContent = $this->renderOnlyView($view,$param);
        return str_replace("{{content}}", $viewContent, $layoutContent);      
    }
    protected function layoutContent($param = []){
        $layout = Application::$app->layout;
        if (Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }
        foreach ($param as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/layout/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view,$param=[]){
       
        foreach($param as $key => $value){
            $$key = $value;
        }
        // var_dump($param);
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}        
        
?>