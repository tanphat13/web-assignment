<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\exception\NotFound;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\Categories;
use app\models\Product;
use app\models\Branch;
use app\models\Comment;
use app\models\Rating;
use app\models\User;
use app\models\Order;
use app\models\OrderProduct;
use app\models\ProductItem;
use app\models\Address;
use Exception;

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
        $param = $request->getBody();
        $listField = array_keys($param);
        if (in_array('email', $listField) && in_array('password', $listField)) {
            self::login($_SERVER['REQUEST_URI'], $loginForm, $request, $response);
        }
        $product = (new Product())->getSpecificProduct(intval($param['id']));
        $comments = (new Comment())->getRecentComment($param['id']);
        return $this->render('product', ['product' => $product, 'comments' => $comments, 'session' => $session]);
    }

    // address
    public function manageUserAddress(Request $request, Response $response) {
        $loginForm = new LoginForm();
        $session = Application::$app->session;
        $param = $request->getBody();
        $path = $request->getPath();
        $listField = array_keys($param);
        if (in_array('email', $listField) && in_array('password', $listField)) {
            self::login($path, $loginForm, $request, $response);
        }
        $user_id = $session->get('user');
        if ($user_id === FALSE) {
            $exception = new Exception("User Not Found! Please Login First", 404);
            return $this->render('__error', ['exception' => $exception]);
        }
        $user = (new User())->getUserInfo($user_id);
        $user_address = (new Address())->getUserAddress($user_id);
        return $this->render('address', ['user' => $user, 'address' => $user_address]);
    }

    public function addNewAddress(Request $request, Response $response) {
        $session = Application::$app->session;
        $body = $request->getBody();
        if ((new Address())->addNewAddress($session->get('user'), $body['new-address'])) $response->redirect("/address"); 
    }

    public function deleteAddress(Request $request) {
        $body = $request->getBody();
        (new Address())->deleteAddress($body['user_id'], $body['address']);
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

    // Review Cart
    public function reviewCart(Request $request, Response $response) {
        $loginForm = new LoginForm();
        $session = Application::$app->session;
        $path = $request->getPath();
        $listField = array_keys($request->getBody());
        if (in_array('email', $listField) && in_array('password', $listField)) {
            self::login($path, $loginForm, $request, $response);
        }
        $listProductId = explode(',', $session->get('cart'));
        if (isset($_COOKIE['productId'])) {
            array_push($listProductId, $_COOKIE['productId']);
            array_multisort($listProductId);
            $newListAsString = implode(',', $listProductId);
            $session->set('cart', $newListAsString);
            setcookie('productId', '', 0,'/');            
        }
        $listProducts = array();
        if (array_search('0', $listProductId) !== false || array_search('', $listProductId) !== false) {
            array_shift($listProductId);
            $newListAsString = implode(',', $listProductId);
            $session->set('cart', $newListAsString);
        }
        $listProducts = (new Product())->getProductInCart($listProductId);
        $user = (new User())->getUserInfo($session->get('user'));    
        return $this->render('cart', ["listProducts" => $listProducts, "user" => $user]);
    }

    public function removeProduct(Request $request) {
        $session = Application::$app->session;
        $body = $request->getBody();
        $removing_id = $body['removing_id'];
        $current_list_id = explode(',', $session->get('cart'));
        $index_of_removing = array_search($removing_id, $current_list_id);
        $current_list_id[$index_of_removing] = 0;
        array_multisort($current_list_id);
        array_shift($current_list_id);
        $session->set('cart', implode(',', $current_list_id));
    }

    public function getUserAddress(Request $request) {

    }

    public function getAllBranch(Request $request) {
        return (new Branch())->getAllBranch();
    }

    public function createOrder(Request $request, Response $response) {
        $session = Application::$app->session;
        $body = $request->getBody();
        $new_order = (new Order())->createNewOrder($body, $session->get('user'));
        (new OrderProduct())->createProductInOrder(intval($new_order->latest_order_id), explode(',', $session->get('cart')));
        $session->set('cart', '');
        $response->redirect("/order?id=$new_order->latest_order_id");
        return;
    }

    public function reviewOrder(Request $request) {
        $session = Application::$app->session;
        $param = $request->getBody();
        $user = (new User())->getUserInfo($session->get('user'));
        $order = (new Order())->getDetailedOrder($param['id']);
        $product_in_order = (new OrderProduct())->getOrderProduct(intval($param['id']));
        $listProductId = array();
        foreach ($product_in_order as $product) {
            array_push($listProductId, $product['product_id']);
        }
        $listProducts = (new Product())->getProductInCart($listProductId);
        return $this->render('order', ["user" => $user, "order" => $order, "listProducts" => $listProducts]);
    }

    public function cancelOrder(Request $request) {
        $param = $request->getBody();
        (new Order())->cancelOrder($param['id']);
        $list_items = (new OrderProduct())->removeProduct($param['id']);
        (new ProductItem())->restockItem($list_items);
        return $list_items;
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
        $session = Application::$app->session;
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            
            if ($model->validate() && $model->login()) {
                $session->set('cart', '0');
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