<?php

namespace app\controller;

use app\core\Controller;
use app\core\Application;
use app\core\Request;
use app\models\LoginForm;
use app\models\User;
use app\core\Response;
use app\core\middleware\AuthMiddleware;

// class AdminController extends Controller{
//     // public function __construct(){
//     //     $this->registerMiddleware(new AuthMiddleware(['admin']));
//     // }
//     public function admin (Request $req,Response $res){
//         //$this->setLayout('AdminLayout');
//         return $this->render('admin');
//     }
// }

Class AdminController extends Controller {
    //  public function __construct(){
    //     $this->registerMiddleware(new AuthMiddleware(['admin']));
    // }
    public function admin (Request $req,Response $res){
        // echo "accsess this function okay";
        // exit;
        $loginForm = new LoginForm();
        $session = Application::$app->session;
        $param =
            ["model" => $loginForm, "session" => $session];
        $path = $req->getPath();
        echo var_dump($path);
        $listField = array_keys($req->getBody());
        //exit;
        if (in_array('email', $listField) && in_array('password', $listField)) {
            self::login($path, $loginForm, $req, $res);
        }
        $this->setLayout('AdminLayout');
        return $this->render('admin',$param);
    }
    public function test (){
        // echo "<pre>";
        // echo var_dump(getcwd());
        // echo "</pre>";
        //exit;
        $this->setLayout('AdminLayout');
        return $this->render("home");
    }
    public static function login($path, LoginForm $model, Request $request, Response  $response)
    {
        //$loginForm = new $model();
        if ($request->isPost()) {
            $model->loadData($request->getBody());

            if ($model->validate() && $model->login()) {
                $response->redirect($path);
                return;
            }
        }
    }
}


?>