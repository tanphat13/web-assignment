<?php
    namespace app\controller;

    use app\core\Controller;
    use app\core\Application;
    use app\core\Request;
    use app\models\LoginForm;
    use app\core\middleware\AuthMiddleware;
    use app\core\Response;
    use app\models\User;
    use app\models\Order;
    use app\models\OrderProduct;
    use app\models\Product;
    use app\models\ProductItem;
    use app\models\Branch;

    Class StaffController extends Controller {
        public function __construct() {
            $this->registerMiddleware(new AuthMiddleware(['manageOrder']));
        }

        public function login(Request $request, Response $response) {
            $loginForm = new LoginForm();
            $session = Application::$app->session;
            $param =
            ["model" => $loginForm, "session" => $session];
            if ($request->isPost()) {
                $loginForm->loadData($request->getBody());
                if ($loginForm->validate() && $loginForm->login()) {
                    $response->redirect('/staff/manage-order?page=1&limit=10');
                    return;
                }
            }
            $this->setLayout('StaffLayout');
            return $this->render('login', $param);
        }

        public function manageOrder(Request $request, Response $response) {
            $session = Application::$app->session;
            $user = $session->get('user');
            if (!$user) {
                $response->redirect('/staff/login');
            }
            if (isset($_GET['page']) && isset($_GET['limit'])) {
                $page = intval($_GET['page']);
                $limit = intval($_GET['limit']);
            } else {
                $page = 1;
                $limit = 10;
            }
            $result = (new Order())->manageOrder($page, $limit);
            $totalPage = $result['total_page'];
            $order_list = $result['order_list'];
            $this->setLayout('staffLayout');
            return $this->render('manage-order',['order_list'=>$order_list,'totalPage'=>$totalPage,'page'=>$page]);
        }

        public function reviewOrder(Request $request) {
            $param = $request->getBody();
            $order = (new Order())->getDetailedOrder($param['id']);
            $user = (new User())->getUserInfo($order->user_id);
            $product_in_order = (new OrderProduct())->getOrderProduct(intval($param['id']));
            $listProductInfo= array();
            foreach ($product_in_order as $product) {
                array_push($listProductInfo, $product);
            }
            $listProducts = (new Product())->getProductInCart($listProductInfo);
            $this->setLayout('staffLayout');
            return $this->render('review-order', ["user" => $user, "order" => $order, "listProducts" => $listProducts]);
        }

        public function updateOrder(Request $request) {
            $body = $request->getBody();
            (new Order())->updateOrder($body['order_id'], $body['status'], $body['delivery_date']);
            if ($body['status'] === 'CANCEL') {
                (new Order())->cancelOrder($body['order_id']);
                $list_items = (new OrderProduct())->removeProduct($body['order_id']);
                (new ProductItem())->restockItem($list_items);
            }
        }

        public function renderOrder() {
            $session = Application::$app->session;
            if (($session->get('cart')) === FALSE || $session->get('cart') === '') $session->set('cart', []);
            $products_list = (new Product())->getAllProduct();
            $this->setLayout('staffLayout');
            return $this->render('order-form', ['products_list' => $products_list, 'session' => $session]);
        }

        public function searchProducts(Request $request) {
            $param = $request->getBody();
            return (new Product())->searchProducts($param['key']);
        }

        public function addProduct(Request $request) {
            $session = Application::$app->session;
            $body = $request->getBody();
            $current_list_id = $session->get('cart');
            array_push($current_list_id, intval($body['product_id']));
            $session->set('cart', $current_list_id);
            return;
        }

        public function reviewCart(Request $request, Response $response) {
            $session = Application::$app->session;
            if (($session->get('cart')) === FALSE || $session->get('cart') === '') $session->set('cart', []);
            $listProductId = $session->get('cart');
            $listProductInfo = array();
            foreach ($listProductId as $product_id) {
                array_push($listProductInfo, ['product_id' => $product_id, 'serial_number' => '']);
            }
            $listProducts = (new Product())->getProductInCart($listProductInfo);
            $address = $this->getAllBranch($request);
            $this->setLayout('staffLayout');
            return $this->render('review-cart', ["listProducts" => $listProducts, "storeAddress" => $address]);
        }

        public function getAllBranch(Request $request) {
            $list_branches = (new Branch())->getAllBranch();
            $branchOption = '';
            foreach ($list_branches as $branch) {
                $branchOption .= "<div class='form-check form-check-inline'>
                    <input class='form-check-input' type='radio' name='address' id='$branch[branch_id]' value='$branch[branch_address]' />
                    <label class='form-check-label' for='$branch[branch_id]'>$branch[branch_address] - Contact: $branch[branch_phone]</label>
                </div>";
            }
            return $branchOption;
        }

        public function createOrder(Request $request, Response $response) {
            $session = Application::$app->session;
            $body = $request->getBody();
            $user = new User();
            $user_id = $user->checkExistUser($body['phone']);
            if ( $user_id === FALSE) {
                $user->loadData(['fullname' => $body['name'], 'email' => $body['email'], 'phone' => $body['phone'], 
                'password' => '12345678', 'gender' => 'female', 'status' => 1, 'role' => 'user']);
                $user->save();
                $user_id = (object) array('id' => $user->getLastInsertId());
            }
            $new_order = (new Order())->createNewOrder($body, $user_id->id);
            (new OrderProduct())->createProductInOrder(intval($new_order->latest_order_id), $session->get('cart'));
            $session->set('cart', []);
            $response->redirect("/staff/order?id=$new_order->latest_order_id");
            return;
        }
    }
?>