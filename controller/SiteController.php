<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\Categories;
use app\core\Session;


class SiteController extends Controller{
    public function home(Request $request,Response $response){
        $loginForm = new LoginForm();
        $session = Application::$app->session;
        $listField = array_keys($request->getBody());
        if(in_array('email',$listField) && in_array('password',$listField)){
            if($request->isPost()){
                $loginForm->loadData($request->getBody());
                if($loginForm->validate() && $loginForm->login()){
                   
                    return $this->render('home', ["model" => $loginForm,"session" => $session]);
                }
            }
        }
        return $this->render('home',["model" => $loginForm]);
    }
    public function renderContact()
    {
        $param = [
            'name' => "the NEGA"
        ];
        //echo $this;
        return $this->render('contact',$param);
    }
    public function handleContactSubmit(Request $request){
        $body = $request->getBody();
        return $body;
    }
    public function renderWarranty() {
        return $this->render('warranty',[]);
    }
    public function returnpolicy() {
        return $this->render('returnpolicy',[]);
    }
    public function installment() {
        return $this->render('installment',[]);
    }
    public function renderCategory(Request $request) {
        $param = $request->getBody();
        $categoryList = (new Categories())->getCategoryList();
        // echo var_dump($categoryList[0]);
        // echo var_dump($param);
        if ($param == null) {
            $productList = (new Categories())->getBrandProduct($categoryList[0]);            
        }
        // else $productList = (new Categories())->getBrandProduct($param['brand']);
        else if (array_key_exists('brand', $param))  {
            $productList = (new Categories())->getBrandProduct($param['brand']);
        }
        else if (array_key_exists('low_bound', $param) && array_key_exists('high_bound', $param)) {
            $productList = (new Categories())->getProductByRange($param['low_bound'], $param['high_bound']);
        }
        return $this->render('categories', ['model' => $categoryList, 'product' => $productList]);
    }
}


?>