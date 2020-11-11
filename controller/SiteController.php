<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\core\Session;
use app\models\Product;

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
    public function renderProduct(Request $request) {
        $param = $request->getBody();
        $product = (new Product())->getSpecificProduct(intval($param['id']));
        return $this->render('product', ['model' => $product]);
    }
}


?>