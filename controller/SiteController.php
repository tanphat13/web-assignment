<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
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
}


?>