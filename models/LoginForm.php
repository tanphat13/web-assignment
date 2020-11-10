<?php
    namespace app\models;

use app\core\Application;
use app\core\DbModel;

    class LoginForm extends DbModel{

        public string $email='';
        public string $password= '';
        public function rules(): array
        {
            return [
                'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
                'password' => [self::RULE_REQUIRED],
            ];
        }

        public function tableName(): string
        {
            return 'users';
        }

        public function login(){
            $user = User::findOne(['email'=>$this->email]);
            if(!$user){
                $this->addErrorMessage('email','Email or password not correct!');
                return false;
            }
            if(!password_verify($this->password,$user->password)){
                $this->addErrorMessage('password', 'Email or password not correct!');
                return false;
            }
            // echo "<pre>";
            // echo var_dump($user);
            // echo "</pre>";
            Application::$app->login($user);
            return true;
        }
        public function attribute(): array
        {
            return [];
        }
        public function primaryKey(): string{
            return '';
        }
        public function userRole(): string{
            return '';
        }
    }



?>