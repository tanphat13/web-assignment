<?php

namespace app\controller;

use app\core\Controller;
use app\core\Application;
//use app\core\Controller;
use app\core\Request;
use app\models\LoginForm;
use app\models\User;
use app\core\Response;
use app\core\middleware\AuthMiddleware;

// class AdminController extends Controller{
//     // public function __construct(){
//     //     $this->registerMiddleware(new AuthMiddleware(['admin']));
//     // }
//     public function admin (Request $req,Response $res){
//         //$this->setLayout('AdminLayout');
//         return $this->render('admin');
//     }
// }

Class AdminController extends Controller {
public static $test = 'hello';
     public function __construct(){
        $this->registerMiddleware(new AuthMiddleware(['admin']));
    }
    public function admin (Request $req,Response $res){
        //$this->setLayout('AdminLayout');
        return $this->render('admin');
    }
}


?>