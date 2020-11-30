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
use app\models\Comment;
use app\models\Rating;

class SiteController extends Controller{
    //render HomePage
    
    public function home(Request $request,Response $response){
        $loginForm = new LoginForm();
        $session = Application::$app->session;
        $homepage = (new Categories())->getBrandList();
        $brandlist = (new Categories())->getCategoryList();
        $param =
        ["model" => $loginForm, "session" => $session, "product_home" => $homepage, "brands" => $brandlist];
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
    public function renderProduct(Request $request, Response $response) {
        $loginForm = new LoginForm();
        $session = Application::$app->session;
        $path = $request->getPath();
        $param = $request->getBody();
        $listField = array_keys($param);
        if (in_array('email', $listField) && in_array('password', $listField)) {
            self::login($path, $loginForm, $request, $response);
        }
        $product = (new Product())->getSpecificProduct(intval($param['id']));
        $comments = (new Comment())->getRecentComment($param['id']);
        return $this->render('product', ['product' => $product, 'comments' => $comments, 'session' => $session]);
    }
    // address
    public function addAddress(Request $request){
        $add_Address = new Address();
        $session = Application::$app->session;
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

    public function createComment(Request $request) {
        $body = $request->getBody();
        $commentClass = new Comment();
        $newComment = $commentClass->createComment($body['product_id'], intval($body['user_id']), intval($body['is_answer']), $body['content'], intval($body['answer_id']));
        if ($newComment === true) {
            $comments = $commentClass->getRecentComment($body['product_id']);
            $comments_element = "";
                foreach ($comments as $comment) {
                    if (is_string($comment)) {
                        $comments_element .= "
                            <div id='$comment'></div>
                        ";
                        continue;
                    }
                    $date = date_create($comment['created_at'], timezone_open('Asia/Ho_Chi_Minh'));
                    $date_format = date_format($date, 'H:i - d/m/Y');
                    $comments_element .= "<div class='comment-element";
                    if ($comment['is_answer'] === "2") {
                        $comments_element .= " answer-comment";
                    }
                    $comments_element .= "'>
                        <div class='comment-info'>
                            <p class='font-weight-bold m-0'>" . $comment['fullname'] . "</p>
                            <p class='font-italic text-muted time'>Sent at " . $date_format ."</p>
                        </div>
                        <div class='text-break content'>" . $comment['content'] . "</div>
                ";
                    $comment_id = $comment['answer_id'];
                    if ($comment['is_answer'] === '1') $comment_id = $comment['comment_id'];
                    $comments_element .= "
                        <button onclick='loadAnswerInput($comment_id)'>
                            Reply
                        </button>
                        </div>
                    ";
                }
            echo $comments_element;
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