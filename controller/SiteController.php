<?php
namespace app\controller;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller{
    public function home(){
        return $this->render('home');
    }
    public function renderContact()
    {
        $param = [
            'name' => "the NEGA"
        ];
        //echo $this;
        return $this->render('contact',$param);
    }
    public function handleContactSubmit(Request $request){
        $body = $request->getBody();
        return $body;
    }
}


?>