<?php 
namespace app\core;
use app\core\Controller;
use app\core\Database;

class Application{

        public static string $ROOT_DIR;
        public string $layout ='main_layout';
        public string $userClass ;
        public Request $request;
        public Router $router;
        public Response $response;
        public Session $session;
        public static Application $app;
        public ?Controller $controller;
        public Database  $db;
        public ?UserModel $user;
        public function __construct($rootPath,array $config){
            self::$ROOT_DIR = $rootPath;
            self::$app = $this;
            $this->userClass = $config['user'];
            $this->request  =  new Request();
            $this->session = new Session();
            $this->response  =  new Response();
            $this->controller = new Controller();
            $this->router = new Router($this->request, $this->response);
            $this->db = new Database($config['db']);  

            
            $primaryValue = $this->session->get('user');
            if($primaryValue){
                $primaryKey = $this->userClass::primaryKey();
                $this->user= $this->userClass::findOne([$primaryValue => $primaryValue ]);

            }else{
                $this->user = null;
            }
        }
        private function setController(Controller $controller){
            $this->controller = $controller;
        }
        public function getController(){
            return $this->controller;
        }
        public function run(){
            try{
                echo $this->router->resolve();
            }catch(\Exception $e){
                $this->response->setStatusCode($e->getCode());
                echo $this->router->renderViews('__error',['exception'=>$e]);
            }   
            
        }
        public function login (DbModel $user){
            $this->user = $user ;
            $primaryKey  = $user->primaryKey();
            $primaryValue = $user->{$primaryKey};
            $this->session->set('user',$primaryValue);
        }
        public function logout(){
            $this->session->remove('user');
            $this->user = null ;
        }

        public function isGuest(){
            return !self::$app->user;
        }
    }
?>