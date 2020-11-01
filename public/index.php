<?php   


use app\core\Application;
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

$app->router->get('/contact', [SiteController::class,"renderContact"]);

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

$app->run();

?>