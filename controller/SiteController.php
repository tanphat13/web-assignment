<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\Categories;
use app\core\Session;
use app\models\Product;
use app\models\Branch;
use app\models\Rating;

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

    public function Contact()
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
    
    // Render Page For Specific Product
    public function renderProduct(Request $request) {
        $param = $request->getBody();
        $product = (new Product())->getSpecificProduct(intval($param['id']));
        return $this->render('product', ['product' => $product]);
    }

    public function getBranch(Request $request) {
        $param = $request->getBody();
        return (new Branch())->getAvailableBranch(intval($param['id']));
    }

    public function updateRating(Request $request) {
        $body = $request->getBody();
        $rating = (new Rating())->updateRating($body['product_id'], $body['user_id'], $body['rate']);
        if ($rating === TRUE) {
            (new Product())->updateProductRating($body['product_id'], $body['rate']);
        }
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
        return $this->render('categories', ['category' => $categoryList, 'product' => $productList]);
    }
}


?>