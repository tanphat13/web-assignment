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
        if (!$user) {
            $res->redirect('/admin/login');
        }
        $page = 0;
        if(isset($_GET['page']) && isset($_GET["limit"])){
            $page=intval($_GET['page']);
            $limit = intval($_GET['limit']);
        }else{
            $page = 1;
            $limit = 10;
        }
       
        $fetchResult = $adminModel->getStaffList($page,$limit);
        $totalPage = $fetchResult['totalPage'];
        $staffList = $fetchResult['staffList'];  
        $this->setLayout('adminLayout');
        return $this->render('admin',['model'=>$adminModel,'staffList'=>$staffList,'totalPage'=>$totalPage,'page'=>$page]);
       
    }


    public  function login(Request $req,Response $res){
        $loginForm = new LoginForm();
        $session = Application::$app->session;
        $param =
            ["model" => $loginForm, "session" => $session];
        if ($req->isPost()) {
            $loginForm->loadData($req->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $res->redirect('/admin?page=1&limit=10');
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
    public function getSpecificStaff(){
        $admin =  new Admin() ;
        $staffId = $_GET['id'];
        $staffJSON = json_encode($admin->getStaff($staffId));
        echo $staffJSON;
    }
    public function  updateStaff(Request $req,Response $res){
        $dataStr = array_keys($_REQUEST)[0];
        $dataArr = json_decode($dataStr, true);
        $staff = new Staff();
        // echo $staff->loadData($dataArr);
        if($req->isPost()){
             $staff->loadData($dataArr);
            if($staff->validate()){
                if($staff->updateStaffInfo()){
                    echo "Update successfull";
                    return;
                }else{
                    echo "Update faild";
                }
            }
        }
    }
    public function search(){
        $option = $_GET['options'];
        $key = $_GET['key'];
        $staffModel = new Staff();
        $searchResult = $staffModel->searchStaff($option,$key);
        echo $searchResult;
       
    }
}


?>