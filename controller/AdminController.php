<?php

namespace app\controller;

use app\core\Controller;
use app\core\Application;
use app\core\Request;
use app\models\LoginForm;
use app\models\User;
use app\core\Response;
use app\core\middleware\AuthMiddleware;
use app\core\Session;
use app\models\Admin;
use app\models\Staff;

Class AdminController extends Controller {
    public function __construct(){
        $this->registerMiddleware(new AuthMiddleware(['createStaff']));
    }
    public function admin (Request $req,Response $res){
        $session = new Session();
        $adminModel = new Admin();
        $user = $session->get('user');
        // echo "<pre>";
        // echo var_dump($user);
        // echo "</pre>";
        // exit;
        if(!$user){
            $res->redirect('/admin/login');
        }
        $adminModel = new Admin();
        $staffList = $adminModel->getStaffList();
        $this->setLayout('adminLayout');
        return $this->render('admin',['model'=>$adminModel,'staffList'=>$staffList]);
       
    }


    public  function login(Request $req,Response $res){
        $loginForm = new LoginForm();
        $session = Application::$app->session;
        $param =
            ["model" => $loginForm, "session" => $session];
        if ($req->isPost()) {
            $loginForm->loadData($req->getBody());

            if ($loginForm->validate() && $loginForm->login()) {
                $res->redirect('/admin');
                return;
            }
        }
        $this->setLayout('AdminLayout');
        return $this->render('login', $param);
    }
    public function  createStaff(Request $req,Response $res){
        $staff = new Staff();
        if($req->isPost()){
                $staff->loadData($req->getBody());
                if($staff->validate() && $staff->save()){
                    Application::$app->session->setFlash("success", "Create new staff scucessfull");
                    $res->redirect('/admin');
                }
        }
        $this->setLayout('adminLayout');
        return $this->render('create-staff', ['model' => $staff]);
       
    }
}


?>