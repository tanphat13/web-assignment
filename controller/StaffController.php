<?php
    namespace app\controller;

    use app\core\Controller;
    use app\core\Application;
    use app\core\Request;
    use app\models\LoginForm;
    use app\core\middleware\AuthMiddleware;
    use app\core\Response;
    use app\model\User;
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
                    $response->redirect('/staff/manage-order?page=1&limit=2');
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
    }
?>