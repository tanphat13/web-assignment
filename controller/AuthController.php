<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\LoginForm;
use app\models\User;
use app\core\Response;
use app\core\middleware\AuthMiddleware;


class AuthController extends Controller{
    //  public AuthMiddleware $authMiddleware;
    /**
     * @var app\core\middlewares\AuthMiddleware
     */
    public function __construct()
    {   
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response){
        $loginForm =  new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login()){
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('login',["model"=>$loginForm]);
    }
    public function register(Request $request){

        $users = new User();
        $errors = [];
        if($request->isPost()){
            $users->loadData($request->getBody());
            if($users->validate() && $users->save()){
                   Application::$app->session->setFlash("success","Thank for registering");
                   Application::$app->response->redirect('/');
                   exit;
            }
            return $this->render('register',[
                'model' => $users
            ]);
        }
        $this->setLayout('auth');
        return $this->render("register", [
            'model' => $users
        ]);
    }
    public function logout(Request $req, Response $res){
        Application::$app->logout();
        $res->redirect('/');
    }
    public function profile (){
        return $this->render('profile');
    }
    public function admin()
    {
        return $this->render('admin');
    }
}   


?>