<?php


use app\core\Application;
use app\controller\AdminController;
use app\controller\SiteController;
use app\controller\AuthController;

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

$app->router->get('/contact', [SiteController::class,"renderContact",['admin', 'user']]);

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
 $app->router->get('/admin/login', [AdminController::class, 'test']);
// $app->router->get('/admin', [AdminController::class, 'admin']);
$app->router->get('/admin', [\app\controller\AdminController::class, 'admin']);
$app->run();
?>