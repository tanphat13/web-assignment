<?php


use app\core\Application;
use app\controller\AdminController;
use app\controller\SiteController;
use app\controller\AuthController;
use app\controller\StaffController;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config =[
    'user' => \app\models\User::class,
    'db'=>[
        'dsn'=>$_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app  = new Application(dirname(__DIR__),$config);

$app->router->get('/',[SiteController::class,'home']);
$app->router->post('/', [SiteController::class, 'home']);

$app->router->get('/contact', [SiteController::class,"Contact",['admin', 'user']]);

$app->router->post('/contact', [SiteController::class, 'handleContactSubmit']);

//render login or register form
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);

// handle submit data for login or register
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);

//End for authentication

$app->router->get('/profile', [AuthController::class, 'profile']);

// Specific product request
$app->router->get('/product', [SiteController::class, 'renderProduct']);
$app->router->post('/product', [SiteController::class, 'renderProduct']);
$app->router->get('/branch', [SiteController::class, 'getBranch']);
$app->router->post('/rating', [SiteController::class, 'updateRating']);
$app->router->post('/comment', [SiteController::class, 'createComment']);

//add address function
$app->router->get('/profile', [SiteController::class, 'manageUserAddress']);
$app->router->post('/profile', [SiteController::class, 'manageUserAddress']);
$app->router->post('/add-address', [SiteController::class, 'addNewAddress']);
$app->router->post('/delete-address', [SiteController::class, 'deleteAddress']);
$app->router->post('/update-info', [SiteController::class, 'updateInfo']);

// Review Cart
$app->router->get('/my-cart', [SiteController::class, 'reviewCart']);
$app->router->post('/my-cart', [SiteController::class, 'reviewCart']);
$app->router->post('/remove-product', [SiteController::class, 'removeProduct']);
$app->router->get('/my-address', [SiteController::class, 'getUserAddress']);
$app->router->get('/all-branch', [SiteController::class, 'getAllBranch']);
$app->router->post('/ordering', [SiteController::class, 'createOrder']);

// Review My Order
$app->router->get('/my-order', [SiteController::class, 'reviewAllOrder']);
$app->router->post('/my-order', [SiteController::class], 'reviewAllOrder');

// Review Specific Order
$app->router->get('/order', [SiteController::class, 'reviewOrder']);
$app->router->get('/cancel-order', [SiteController::class, 'cancelOrder']);

//Footer
$app->router->get('/warranty', [SiteController::class, 'warranty']);
$app->router->get('/returnpolicy', [SiteController::class, 'returnpolicy']);
$app->router->get('/installment', [SiteController::class, 'installment']);
$app->router->get('/category', [SiteController::class, 'renderCategory']);
$app->router->post('/warranty', [SiteController::class, 'warranty']);
$app->router->post('/returnpolicy', [SiteController::class, 'returnpolicy']);
$app->router->post('/installment', [SiteController::class, 'installment']);

// For admin routers
//$app->router->get('/admin', [AdminController::class, 'admin']);
// $app->router->get('/admin/login/user', [AdminController::class, 'test']);
$app->router->get('/admin', [AdminController::class, 'admin',['admin']]);
$app->router->get('/admin/login', [AdminController::class, 'login']);
$app->router->get('/admin/create-new-staff', [AdminController::class, 'createStaff', ['admin']]);
$app->router->post('/admin/create-new-staff', [AdminController::class, 'createStaff',['admin']]);
$app->router->post('/admin/login', [AdminController::class, 'login']);
$app->router->get('/admin/specific-staff',[AdminController::class, 'getSpecificStaff',['admin']]);
$app->router->post('/admin/update-staff-info', [AdminController::class, 'updateStaff', ['admin']]);
$app->router->get('/admin/search', [AdminController::class, 'search', ['admin']]);
$app->router->get('/admin/manage-products', [AdminController::class, 'manageProduct', ['admin']]);
$app->router->get('/admin/manage-products/update-product', [AdminController::class, 'getUpdateProduct', ['admin']]);
$app->router->post('/admin/manage-products/update-specific-product', [AdminController::class, 'postUpdateProduct', ['admin']]);
$app->router->get('/admin/add-new-product', [AdminController::class, 'addNewProduct', ['admin']]);
$app->router->post('/admin/add-new-product', [AdminController::class, 'addNewProduct', ['admin']]);
// $app->router->get('/admin', [\app\controller\AdminController::class, 'admin']);

// For Staff router
$app->router->get('/staff/login', [StaffController::class, 'login']);
$app->router->post('/staff/login', [StaffController::class, 'login']);
$app->router->get('/staff/manage-order', [StaffController::class, 'manageOrder']);
$app->run();
?>