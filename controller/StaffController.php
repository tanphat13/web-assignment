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
            $listProductId = array();
            foreach ($product_in_order as $product) {
                array_push($listProductId, $product);
            }
            $listProducts = (new Product())->getProductInCart($listProductId);
            $this->setLayout('staffLayout');
            return $this->render('review-order', ["user" => $user, "order" => $order, "listProducts" => $listProducts]);
        }

        public function updateOrder(Request $request) {
            $body = $request->getBody();
            (new Order())->updateOrder($body['order_id'], $body['status'], $body['delivery_date']);
        }

        public function renderOrder() {
            $products_list = (new Product())->getAllProduct();
            $this->setLayout('staffLayout');
            return $this->render('order-form', ['products_list' => $products_list]);
        }
    }
?>