<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;



class SiteController extends Controller{
    //render HomePage
    
    public function home(Request $request,Response $response){
        $loginForm = new LoginForm();
        $session = Application::$app->session;
        $param =
        ["model" => $loginForm, "session" => $session];
        $path = 'home';
        $listField = array_keys($request->getBody());
        //exit;
        if(in_array('email',$listField) && in_array('password',$listField)){
            self::login($path, $loginForm, $request, $response);
        }
        return $this->render('home', $param);
    }

    public function renderContact()
    {
        $param = [
            'name' => "the NEGA"
        ];
        return $this->render('contact',$param);
    }


    //render view ...
    public function handleContactSubmit(Request $request){
        $body = $request->getBody();
        return $body;
    }
    // render view ...
    public function warranty(Request $request, Response $response) {
        $loginForm = new LoginForm();
        $session = Application::$app->session;
        $param =
            ["model" => $loginForm, "session" => $session];
        $path = $request->getPath();
        $listField = array_keys($request->getBody());
        if (in_array('email', $listField) && in_array('password', $listField)) {
            self::login($path, $loginForm, $request, $response);
        }
        return $this->render('warranty',$param);
    }

    //Render View ...
    public function returnpolicy(Request $request, Response $response) {
        $loginForm = new LoginForm();
        $session = Application::$app->session;
        $param =
            ["model" => $loginForm, "session" => $session];
        $path = $request->getPath();
        $listField = array_keys($request->getBody());
        // echo "<pre>";
        // echo var_dump($request);
        // echo "</pre>";
        // exit;
        if (in_array('email', $listField) && in_array('password', $listField)) {
            self::login($path, $loginForm, $request, $response);
        }
        return $this->render('returnpolicy',$param);
    }


    //Render View ...
    public function installment(Request $request, Response $response) {
        $loginForm = new LoginForm();
        $session = Application::$app->session;
        $param =
            ["model" => $loginForm, "session" => $session];
        $listField = array_keys($request->getBody());
        $path = 'installment';
       
        //exit;
        if (in_array('email', $listField) && in_array('password', $listField)) {
            self::login($path, $loginForm, $request, $response);
        } 
        return $this->render('installment',$param);
    }


    //function login for login form on main layout;
    public static function login($path,LoginForm $model,Request $request,Response  $response){
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