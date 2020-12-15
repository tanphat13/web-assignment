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
use app\models\Product;
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
    public function manageProduct(Request $req, Response $res)
    {
        $session = new Session();
        $adminModel = new Admin();
        $user = $session->get('user');
        $page = 0;
        if (!$user) {
            $res->redirect('/admin/login');
        }
        
        if (isset($_GET['page']) && isset($_GET["limit"])) {
            $page = intval($_GET['page']);
            $limit = intval($_GET['limit']);
        } else {
            $page = 1;
            $limit = 10;
        }
        $fetchResult =$adminModel->getProductList($page,$limit);  
        $totalPage = $fetchResult['totalPage'];
        $productList = $fetchResult['productList'];
        $this->setLayout('adminLayout');
        return $this->render('admin-product', ['model' => $adminModel, 'productList' => $productList, 'totalPage' => $totalPage, 'page' => $page]);
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
                    Application::$app->session->setFlash("success", "Create new staff successful");
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
                    echo "Update successful";
                    return;
                }else{
                    echo "Update fail";
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
    public function getUpdateProduct(){
        $adminModel = new Admin();
        $productId = $_GET['product_id'];
        $queried_product = $adminModel->getSpecificProduct($productId);
        $product_array = get_object_vars($queried_product);
        $this->setLayout('adminLayout');
        return $this->render('admin-update-product', ['model' => $adminModel, 'product_item'=>$product_array]);
    }
    public function postUpdateProduct(Request $req, Response $res){
         // echo array_keys($_REQUEST)[0];
         $dataArray = json_decode(array_keys($_REQUEST)[0],true);
         $product = new Product();
         //echo var_dump($dataArray); 
         $product->loadData($dataArray);
         //echo var_dump($product);
        if ($req->isPost()) {
            $product->loadData($dataArray);
                if ($product->updateProduct()) {
                    echo "Update successfull";
                    return;
                } else {
                    echo "Update faild";
                }
        }
    }
    public function addNewProduct(Request $req ,Response $res){
        $product = new Product();
        
        if ($req->isPost()) {
            if (!isset($_FILES)) {
                return;
            }
            $product->loadData($req->getBody());
            if ($product->validate() && $product->save()) {
                $newProductId = $product->getLastInsertId();
                $targetDir = dirname(__DIR__) . "/public/assets/";
                $targetFile = $targetDir . basename($_FILES['fileupload']['name']);
                move_uploaded_file($_FILES['fileupload']['tmp_name'], $targetFile);
                $newProductImages = "/assets/".basename($_FILES['fileupload']['name']); 
                if($product->saveImage($newProductImages,$newProductId)){
                    Application::$app->session->setFlash("success", "Add new product successfull");
                    $res->redirect('/admin/manage-products');
                }else{
                    Application::$app->session->setFlash("fail", "Create new product fail");
                    $res->redirect('/admin/manage-products');
                }
                
            }
        }
        
        $this->setLayout('adminLayout');
        return $this->render('admin-add-product',['model'=>$product]);
    }
    public function deleteModel(Request $req,Response $res){
        $model = $_GET['delete'];
        $key = $_GET['key'];
        if(isset($_GET['delete']) && $model ==='product'){
            $product =new Product();
            if($product->delete($key)){
                echo "Delete successfull";
            }else{
                echo "Something wrong please try it later";
            }

        }
        if (isset($_GET['delete']) && $model === 'users') {
            $staff = new Staff();
            if ($staff->delete($key)) {
                echo "Delete successfull";
            } else {
                echo "Something wrong please try it later";
            }
        }
    }
    public function testingUploadFile(Request $req, Response $res){
        
        echo var_dump(dirname(__DIR__));
        echo"<pre>";
        echo var_dump($_FILES);
        echo "</pre>";
        $targetDir = dirname(__DIR__) . "/public/assets/";
        $targetFile = $targetDir . basename($_FILES['fileupload']['name']);
        echo var_dump($targetFile);
        if(move_uploaded_file($_FILES['fileupload']['tmp_name'],$targetFile)){
            echo "<pre>";
            echo "upload success";
            echo "</pre>";
        }else{
            echo "File not saved";
        }
        
        $this->setLayout('adminLayout');
        return $this->render('upload');
    }
}


?>